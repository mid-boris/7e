<?php
namespace Modules\Entrust\Services;

use Modules\Entrust\Entities\Role;
use Modules\Entrust\Entities\RoleNode;
use Modules\Entrust\Repositories\NodeRepository;

class NodePermissionService
{
    private $nodeRepo;

    public function __construct(NodeRepository $nodeRepo)
    {
        $this->nodeRepo = $nodeRepo;
    }

    public function addUriPermissionToNode(string $uri, string $nodeName)
    {
        /** @var \Modules\Entrust\Entities\Node $node */
        $node = $this->nodeRepo->getByNodeName($nodeName);
        if (!$node) {
            return false;
        }
        $node->permission()->create([
            'uri' => $uri,
        ]);
        return true;
    }

    public function roleHasPermissionByRoleIdAndUri(int $roleId, string $uri)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $roleNode */
        $roleNode = new RoleNode;
        return $roleNode->whereExists(function ($query) use ($uri) {
            /** @var \Illuminate\Database\Eloquent\Builder $query */
            $query->select('id')
                ->from('node_permission')
                ->where('uri', $uri)
                ->whereRaw('role_node.node_id = node_permission.node_id');
        })->where('role_id', $roleId)->count();
    }
}
