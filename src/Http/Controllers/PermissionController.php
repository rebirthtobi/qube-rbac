<?php 

namespace RebirthTobi\QubeRbac\Http\Controllers;

//Todo: check the right method to use config
use Illuminate\Config\Repository as Config;
use Illuminate\Routing\Controller as BaseController;
use RebirthTobi\QubeRbac\Http\Requests\PermissionRequest;
use RebirthTobi\QubeRbac\Models\Permission;

/**
 * This file is part of Entrust GUI,
 * A Laravel 5 GUI for Entrust.
 *
 * @license MIT
 * @package Acoustep\EntrustGui
 */
class PermissionsController extends BaseController
{
    /**
     * Create a new PermissionsController instance.
     *
     * @param Request $request
     * @param Config $config
     * @param PermissionGateway $gateway
     *
     * @return void
     */
    public function __construct(Request $request, Config $config, PermissionGateway $model)
    {
        parent::__construct($request, $config, $model, 'permissions', 'role');
    }

    public function index()
    {
        $permissions = Permission::withTrashed()->get();

        return view('quberbac::permission.index', compact('permissions'));
    }

    public function create()
    {
        $rbacs = rbac_controllers();

        return view('quberbac::permission.create', compact('rbacs'));
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->except('_token'));

        session()->flash('success', 'You have successfully save the permission');
        return redirect()->route('permission');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        
        return view('quberbac::permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->except('_token'));
        
        session()->flash('success', 'You have successfully save the permission');
        return redirect()->route('permission');
    }

    public function deactivate($id)
    {
        $permission = Permission::findOrFail($id);        
        $permission->delete();

        session()->flash('success', 'You have successfully deactivate the permission');
        return redirect()->route('permission');
    }

    public function activate($id)
    {
        $permission = Permission::withTrashed()->findOrFail($id);        
        $permission->restore();

        session()->flash('success', 'You have successfully activate the permission');
        return redirect()->route('permission');
    }

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->forceDelete();

        session()->flash('success', 'You have successfully deleted the permission');
        return redirect()->route('permission');
    }
}
