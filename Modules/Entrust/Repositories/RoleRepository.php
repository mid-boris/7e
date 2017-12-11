<?php

namespace Modules\Entrust\Repositories;

use Modules\Entrust\Entities\Role;

class RoleRepository extends EntrustBaseRepository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
        parent::__construct();
    }

    public function getPagination(int $perpage = 35)
    {
        /** @var \Eloquent $role */
        $role = new Role;
        return $role->where('name', '!=', 'admin')->orderBy('id', 'DESC')->paginate($perpage);
    }

    public function getAllExceptAdmin()
    {
        /** @var \Eloquent $role */
        $role = new Role;
        return $role->where('name', '!=', 'admin')->orderBy('id', 'ASC')->get();
    }

    public function getAll()
    {
        /** @var \Illuminate\Database\Eloquent\Model $role */
        $role = new Role;
        return $role->with(['nodeP'])->get();
    }

    public function create(string $name)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $role */
        $role = new Role;
        return $role->fill([
            'name' => $name,
        ])->save();
    }

    public function getByName(string $name)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $role */
        $role = new Role;
        return $role->where('name', $name)->first();
    }

    public function getById(int $id)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $role */
        $role = new Role;
        return $role->where('id', $id)->first();
    }

    public function update(string $name, int $id)
    {
        /** @var \Eloquent $role */
        $role = new Role;
        return $role->where('id', $id)
            ->update([
                'name' => $name
            ]);
    }

    public function delete(int $id)
    {
        /** @var \Eloquent $role */
        $role = new Role;
        return $role->where('id', $id)->delete();
    }
}
