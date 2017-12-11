<?php

namespace Modules\Entrust\Repositories;

use DB;
use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Entrust\Entities\Node;

class NodeRepository extends EntrustBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 所有節點
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        /** @var \Illuminate\Database\Eloquent\Model $node */
        $node = new Node;
        return $node->all();
    }

    /**
     * 可以帶入parent name
     * @param string $nodeName
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getByNodeName(string $nodeName)
    {
        $node = new Node;
        return $node->getExistsParent('name', $nodeName);
    }

    public function create(string $name, $icon = 'fa-circle-o', $uri = null, string $parentName = null, $visible = 1)
    {
        $data = [
            'name' => $name,
            'uri' => $uri,
            'icon_class' => $icon,
            'visible' => $visible,
        ];
        if (!is_null($parentName)) {
            /** @var \Illuminate\Database\Eloquent\Builder $node */
            $node = new Node;
            /** @var Node $parent */
            $parent = $node->where('name', $parentName)->first();
            if ($parent) {
                $data['parent_id'] = $parent->id;
            }
        }
        $node = new Node;
        $result = $node->fill($data)->save();
        return $result;
    }
}
