<?php namespace Acoustep\EntrustGui\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Config\Repository as Config;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

/**
 * This file is part of Entrust GUI,
 * A Laravel 5 GUI for Entrust.
 *
 * From http://stackoverflow.com/a/29186175
 *
 * @license MIT
 * @package Acoustep\EntrustGui
 */
class AdminAuth
{

    protected $auth;
    protected $config;
    protected $response;
    protected $redirect;

    /**
     * Create a new AdminAuth instance.
     *
     * @param Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth, Config $config, Response $response, Redirector $redirect)
    {
        $this->auth = $auth;
        $this->config = $config;
        $this->response = $response;
        $this->redirect = $redirect;
    }

    /**
     * Handle the request
     *
     * @param mixed $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                abort(401, 'Unauthenticated action');
            } else {
                return $this->redirect->guest($this->config->get('entrust-gui.unauthorized-url', 'auth/login'));
            }
        } elseif (! $request->user()->hasRole($this->config->get('entrust-gui.middleware-role'))) {
            abort(403, 'Unauthorized action'); //Or redirect() or whatever you want
        }
        return $next($request);
    }

    public function handle($request, Closure $next)
    {
        $access = false;
        $roles = $this->hasRoles();

        $actions = $this->hasPermission($roles);
        
        $route = $request->route()->getAction();
        $fullvalue = substr($route['controller'], strripos($route['controller'], '\\') + 1);
        
        if(in_array($fullvalue, $actions)){
            $access = True;
        }

        if(!$access){
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }

    private function hasRoles(){
        $roles = Login::where('id', auth()->user()->id)->has('roles')->first();
        
        if($roles->roles->isEmpty()){
            abort(403, 'Unauthorized Entry to the System');
        }
        else{
            return $roles->roles;
        }

    }

    private function hasPermission($roles){

        $actions = [];

        foreach($roles as $role){
            $permissions = Role::where('id', $role->id)->with('permissions')->first();
            if(!$permissions->permissions->isEmpty()){
                foreach($permissions->permissions as $permission){
                    array_push($actions, $permission->controller);
                }
            }
        }
        if(empty($actions)){
            abort(403, 'No Permission Assigned');
        }
        else{
            return $actions;
        }
    }
}
