<?php
namespace Modules\Announcement\Services;

use Illuminate\Http\UploadedFile;
use Modules\Announcement\Entities\Announcement;
use Modules\Image\Entities\ImageFile;

class AnnouncementService
{
    private $dir = '/images/announcement';

    public function create(
        string $title,
        string $content,
        string $language,
        int $type,
        int $status,
        int $highLight,
        $image = null,
        $startTime = null,
        $endTime = null
    ) {
        // 有時間的情況下先進行處理
        $this->timeProcess($startTime);
        $this->timeProcess($endTime, 1);

        $createData = [
            'status' => $status,
            'type' => $type,
            'high_light' => $highLight,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        $announcement = new Announcement;
        $announcement->fill($createData)->save();

        // 處理語系內文
        $announcement->content()->create([
            'language' => $language,
            'title' => $title,
            'content' => $content,
        ]);

        // 處理圖片
        if (!is_null($image)) {
            $this->fileProcess($image, $announcement->getKey());
        }
    }

    public function update(
        int $announcementId,
        string $title,
        string $content,
        string $language,
        int $type,
        int $status,
        int $highLight,
        $image = null,
        $startTime = null,
        $endTime = null
    ) {
        // 有時間的情況下先進行處理
        $this->timeProcess($startTime);
        $this->timeProcess($endTime, 1);

        $updateData = [
            'status' => $status,
            'type' => $type,
            'high_light' => $highLight,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        $announcement = new Announcement;
        $announcement->where('id', $announcementId)
            ->update($updateData);

        $relateUpdateData = [
            'title' => $title,
            'content' => $content,
        ];
        // 更新內文
        $announcement = $announcement->find($announcementId);
        $announcement->content()->updateOrCreate(
            [
                'announcement_id' => $announcementId,
                'language' => $language,
            ],
            $relateUpdateData
        );

        // 圖片更新
        if (!is_null($image)) {
            $this->imageIfExistsToDelete($announcementId);
            $this->fileProcess($image, $announcementId);
        }
    }

    private function timeProcess(&$time, $plusDay = 0)
    {
        if (!is_null($time)) {
            $time = strtotime($time . "+{$plusDay} days");
        }
    }

    private function imageIfExistsToDelete(int $announcementId)
    {
        /** @var Announcement $announcement */
        $announcement = Announcement::has('images')->with(['images'])->where('id', $announcementId)->first();
        if ($announcement) {
            $image = $announcement->images[0];
            $path = $this->dir . "/{$image->saved_uri}";
            $deleted = \Storage::disk('real_public')->delete($path);
            if ($deleted) {
                $announcement->images()->detach();
            }
        }
    }

    private function fileProcess(UploadedFile $image, int $announcementId)
    {
        // 儲存圖片
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($this->dir);
        $result = $image->move($destinationPath, $fileName);
        if ($result) {
            \DB::transaction(function () use ($result, $announcementId) {
                $image = new ImageFile;
                $image->saved_uri = $result->getFilename();
                $image->image_size = $result->getSize();
                list($width, $height) = getimagesize($result->getRealPath());
                $image->image_width = $width;
                $image->image_height = $height;
                $image->save();

                /** @var Announcement $shop */
                $announcement = Announcement::find($announcementId);
                $announcement->images()->attach($image->getKey());
            });
        }
        return $result ? true : false;
    }
}
