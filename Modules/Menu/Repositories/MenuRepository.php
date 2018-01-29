<?php

namespace Modules\Menu\Repositories;

use Modules\Menu\Entities\Menu;

class MenuRepository extends MenuBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPaginationWithIdOrNull($shopId = null)
    {
        /** @var \Eloquent $menu */
        $menu = new Menu;
        return $menu->where('shop_id', $shopId)->orderBy('height_light', 'DESC')->orderBy('id', 'DESC')->paginate(35);
    }

    public function create(array $data)
    {
        /** @var \Eloquent $menu */
        $menu = new Menu;
        return $menu->fill($data)->save();
    }

    public function update(array $data, int $menuId)
    {
        /** @var \Eloquent $menu */
        $menu = new Menu;
        return $menu->where('id', $menuId)->update($data);
    }

    public function delete(int $menuId)
    {
        /** @var \Eloquent $menu */
        $menu = new Menu;
        return $menu->where('id', $menuId)->delete();
    }
}
