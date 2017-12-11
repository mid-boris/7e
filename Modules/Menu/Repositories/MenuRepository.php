<?php

namespace Modules\Menu\Repositories;

use Modules\Menu\Entities\Menu;

class MenuRepository extends MenuBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPaginationWithIdOrNull($id = null)
    {
        /** @var \Eloquent $menu */
        $menu = new Menu;
        return $menu->where('parent_id', $id)->orderBy('id', 'DESC')->paginate(35);
    }

    public function create(array $data)
    {
        /** @var \Eloquent $menu */
        $menu = new Menu;
        return $menu->fill($data)->save();
    }
}
