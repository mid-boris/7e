<?php
namespace Modules\Shop\Service;

use Illuminate\Http\UploadedFile;
use Modules\Image\Entities\ImageFile;
use Modules\RemoteSystem\Src\GoogleMapConnection;
use Modules\Shop\Entities\Shop;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShopService
{
    /**
     * 利用地址從google map查詢相關資訊
     * @param string $address
     * @return mixed
     */
    public function getMapInfoByGoogleMap(string $address)
    {
        /** @var GoogleMapConnection $googleMapConnection */
        $googleMapConnection = app()->make(GoogleMapConnection::class);
        $results = $googleMapConnection->getMapInfoFromAddress($address)->getResults();
        if (count($results)) {
            return $results[0];
        }
        return $results;
    }

    public function hasTrademark(int $shopId)
    {
        /** @var Shop $shop */
        $shop = Shop::has('trademark')->find($shopId);
        return $shop ?? false;
    }

    public function hasPreview(int $shopId)
    {
        /** @var Shop $shop */
        $shop = Shop::has('preview', '>=', '3')->find($shopId);
        return $shop ?? false;
    }

    /**
     * @param int $shopId
     * @param UploadedFile $image
     * @param bool $trademark 預設非商標 false
     * @return bool
     */
    public function imageUpload(int $shopId, UploadedFile $image, $trademark = false)
    {
        // 儲存圖片
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $result = $image->move($destinationPath, $fileName);
        if ($result) {
            \DB::transaction(function () use ($result, $shopId, $trademark) {
                $image = new ImageFile;
                $image->saved_uri = $result->getFilename();
                $image->image_size = $result->getSize();
                list($width, $height) = getimagesize($result->getRealPath());
                $image->image_width = $width;
                $image->image_height = $height;
                $image->save();

                /** @var Shop $shop */
                $shop = Shop::find($shopId);
                $shop->images()->attach($image->getKey(), ['trademark' => $trademark]);
            });
        }
        return $result ? true : false;
    }

    public function makeQRCode(int $shopId)
    {
        /** @var Shop $shop */
        $shop = Shop::find($shopId);
        $codeData = [
            'id' => $shop->id,
            'time' => time(),
        ];
        $destinationPath = public_path('/qrcodes');
        $path = $destinationPath . "/{$shop->id}.png";
        QrCode::format('png')->size(250)->generate(json_encode($codeData), $path);
    }
}
