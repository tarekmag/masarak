<?php

namespace ATPGroup\Roles\Controllers;

use Illuminate\Http\Request;
use ATPGroup\Roles\Models\Role;
use App\Http\Controllers\Controller;
use ATPGroup\Roles\Models\Permission;
use ATPGroup\Roles\Models\RoleAction;
use Illuminate\Support\Facades\Route;
use ATPGroup\Roles\Models\RoleActions;
use ATPGroup\Roles\Models\PermissionActions;
use ATPGroup\Roles\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Role::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('role::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissions(0);
        return view('role::create')->with(['role' => new Role, 'permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = new Role;
        $role->save();
        $this->assignActions($request->actions, $role->id);
        return redirect()->route('role.index')->with('success', __('role::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Roles\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $role)
    {
        $permissions = $this->permissions($role->id);
        return view('role::edit')->with(['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Roles\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        $role->save();
        $this->assignActions($request->actions, $role->id);
        return redirect()->route('role.index')->with('success', __('role::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Roles\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (in_array($role->id, [1])) {
            return response()->json(['status' => 'ok', 'message' => __('role::language.message.deleted')]);
        }
        $role->delete();
        return response()->json(['status' => 'ok', 'message' => __('role::language.message.deleted')]);
    }

    /**
     * Display a listing of role actions the resource without paginate .
     *
     * @param  int  $roleId
     */
    private function permissions($roleId)
    {
        $result = Permission::with('actions')->orderBy('sorting', 'ASC')->get();
        $result = $result->map(function ($item) use ($roleId) {
            $actions = [];
            foreach ($item->actions as $action) {
                $roleAction = RoleAction::where('role_id', $roleId)->where('permission_action_id', $action->id)->first();
                $actions[] = [
                    'id' => $action->id,
                    'name' => $action->name,
                    'checked' => ($roleAction) ? true : false,
                ];
            }
            return [
                'permission_name' => $item->name,
                'permission_actions' => $actions,
            ];
        });
        return $result;
    }

    /**
     * Assign Actions to this role .
     *
     * @param  int  $roleId
     * @param  array  $actions
     */
    private function assignActions($actions, $roleId)
    {
        Role::find($roleId);
        RoleAction::where('role_id', $roleId)->delete();
        if (!empty($actions)) {
            foreach ($actions as $action) {
                $roleAction = new RoleAction;
                $roleAction->role_id = $roleId;
                $roleAction->permission_action_id = $action;
                $roleAction->save();
            }
        }
    }

    /**
     * locked screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function lockedScreen()
    {
        return view('user::locked-screen');
    }
}
