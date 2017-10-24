<?php 

namespace RebirthTobi\QubeRbac\Http\Controllers;

//Todo: check the right method to use config
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller as BaseController;
use RebirthTobi\QubeRbac\Http\Requests\RoleRequest;
use RebirthTobi\QubeRbac\Models\Role;
use RebirthTobi\QubeRbac\Models\Permission;

/**
 * This file is part of Entrust GUI,
 * A Laravel 5 GUI for Entrust.
 *
 * @license MIT
 * @package Acoustep\EntrustGui
 */
class RoleController extends BaseController
{
    /**
     * Create a new RolesController instance.
     *
     * @param Request $request
     * @param Config $config
     * @param RoleGateway $gateway
     *
     * @return void
     */
    public function __construct(Request $request, Router $router, Repository $config)
    {
        $this->request = $request;
        $this->router = $router;
        $this->config = $config;
    }

    public function index()
    {
        $roles = Role::withTrashed()->get();

        return view('quberbac::role.index', compact('roles'));
    }

    public function view($id)
    {
        $role = Role::with('permission')->findOrFail($id);

        return view('quberbac::role.view', compact('role'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('quberbac::role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        Role::create($request->except('_token'));

        session()->flash('success', 'You have successfully save the role');
        return redirect()->route('role');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        
        return view('quberbac::role.edit', compact('role'));
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->except('_token'));
        
        session()->flash('success', 'You have successfully save the role');
        return redirect()->route('role');
    }

    public function deactivate($id)
    {
        $role = Role::findOrFail($id);        
        $role->delete();

        session()->flash('success', 'You have successfully deactivate the role');
        return redirect()->route('role');
    }

    public function activate($id)
    {
        $role = Role::withTrashed()->findOrFail($id);        
        $role->restore();

        session()->flash('success', 'You have successfully activate the role');
        return redirect()->route('role');
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->forceDelete();

        session()->flash('success', 'You have successfully deleted the role');
        return redirect()->route('role');
    }
}
