<?php
namespace Modules\Entrust\Services;

use Modules\Entrust\Entities\Node;
use Modules\Entrust\Entities\Role;
use Modules\Entrust\Repositories\NodeRepository;
use Modules\Entrust\Repositories\RoleRepository;
use Modules\Entrust\Utilities\SessionManager;

class RoleNodeService
{
    /** @var RoleRepository  */
    protected $roleRepo;

    /** @var NodeRepository  */
    protected $nodeRepo;

    public function __construct(RoleRepository $roleRepository, NodeRepository $nodeRepository)
    {
        $this->roleRepo = $roleRepository;
        $this->nodeRepo = $nodeRepository;
    }

    public function getAllRoleAndNode()
    {
        $role = $this->roleRepo->getAll();
        $node = $this->nodeRepo->getAll();
        return [
            'role' => $role,
            'node' => $node,
        ];
    }

    public function getNodesByRole()
    {
        $roleId = SessionManager::getRoleId();
        /** @var \Illuminate\Database\Eloquent\Builder $node */
        $node = new Node;
        $results = $node->whereExists(function ($query) use ($roleId) {
            /** @var \Illuminate\Database\Eloquent\Builder $query */
            $query->select('id')
                ->from('role_node')
                ->where('role_id', $roleId)
                ->whereRaw('role_node.node_id = node.id');
        })->where('visible', 1)->get();
        return $results;
    }

    public function addAllNodeToRole(string $roleName)
    {
        /** @var Role $role */
        $role = $this->getRole($roleName);
        if (!$role) {
            return false;
        }

        $nodes = $this->nodeRepo->getAll();
        $nodeIds = $nodes->pluck('id')->toArray();
        return $this->addNodeToRoleById($role, $nodeIds);
    }

    public function addNodeToRole(string $roleName, string $nodeName)
    {
        /** @var Role $role */
        $role = $this->getRole($roleName);
        if (!$role) {
            return false;
        }

        /** @var Node $node */
        $node = $this->getNode($nodeName);
        if (!$node) {
            return false;
        }
        return $this->addNodeToRoleById($role->getKey(), [$node->getKey()]);
    }

    public function addNodeToRoleById($roleOrmOrNameOrId, array $nodeIds = [])
    {
        if (!$roleOrmOrNameOrId instanceof Role) {
            if (is_numeric($roleOrmOrNameOrId)) {
                /** @var \Eloquent $role */
                $role = new Role;
                $roleOrmOrNameOrId = $role->where('id', $roleOrmOrNameOrId)->first();
            } elseif (is_string($roleOrmOrNameOrId)) {
                $roleOrmOrNameOrId = $this->getRole($roleOrmOrNameOrId);
            }
        }
        if (!$roleOrmOrNameOrId) {
            return false;
        }
        /** @var Role $roleOrmOrNameOrId */
        $roleOrmOrNameOrId->node()->detach();
        if ($nodeIds) {
            $roleOrmOrNameOrId->node()->attach($nodeIds);
        }
        return true;
    }

    private function getRole(string $name)
    {
        return $this->roleRepo->getByName($name);
    }

    private function getNode(string $nodeName)
    {
        return $this->nodeRepo->getByNodeName($nodeName);
    }
}
