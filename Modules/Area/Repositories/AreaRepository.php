<?php

namespace Modules\Area\Repositories;

use Modules\Area\Entities\Area;

class AreaRepository extends AreaBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPaginationWithIdOrNull($id = null)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $area */
        $area = new Area;
        return $area->where('parent_id', $id)->orderBy('id', 'DESC')->paginate(5);
    }

    public function getByNameWithFuzzy(string $name)
    {
        /** @var \Eloquent $area */
        $area = new Area;
        return $area->like('name', $name)->with(['parent'])->get();
    }

    /**
     * App端用
     * @param null $parentId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWithChildrenCount($parentId = null)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $area */
        $area = new Area;
        return $area->withCount(['children'])->with(['children', 'children.children'])
            ->where('status', 1)->where('parent_id', $parentId)->get();
    }

    public function create(string $name, string $parentName = null, $status = 1)
    {
        $data = ['name' => $name];
        if (!is_null($parentName)) {
            /** @var \Illuminate\Database\Eloquent\Builder $area */
            $area = new Area;
            /** @var Area $parent */
            $parent = $area->where('name', $parentName)->first();
            if ($parent) {
                $data['parent_id'] = $parent->id;
            }
        }
        $area = new Area;
        return $area->fill($data)->save();
    }

    public function update(int $id, string $name, $status = 1)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $area */
        $area = new Area;
        return $area->where('id', $id)->update([
            'name' => $name,
            'status' => $status,
        ]);
    }

    public function delete(int $id)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $area */
        $area = new Area;
        return $area->where('id', $id)->delete();
    }
}
