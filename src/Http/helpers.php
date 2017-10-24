<?php

    function rbac(){
        
        $temp_controllers = [];

        foreach (Route::getRoutes()->getRoutes() as $route)
        {

            $parameters = $route->getAction();

            if (array_key_exists('controller', $parameters))
            {
                $fullvalue = substr($parameters['controller'], strripos($parameters['controller'], '\\') + 1);
                //substr($fullvalue, strripos($fullvalue, '@') + 1)
                $html = '<option value="'.strtok($fullvalue, '@').'">'.strtok($fullvalue, '@').'</option>';
                
                array_push($temp_controllers, $html);
            }

            
        }

        $controllers = array_unique($temp_controllers);

        return $controllers;
    }


    function getActions($controller){
        
        $actions = [];

        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            
            $parameters = $route->getAction();
            
            if (array_key_exists('controller', $parameters))
            {
                $fullvalue = substr($parameters['controller'], strripos($parameters['controller'], '\\') + 1);
                $to_check = strtok($fullvalue, '@');
                if($to_check == $controller['module']){
                    $action = substr($fullvalue, strripos($fullvalue, '@') + 1);
                    $temp_array = [
                        'name' => $action,
                        'controller' => $fullvalue
                    ];
                    $actions[] = $temp_array;
                }
            }

            
        }

        return $actions;
    }

    function getRole(){
        $roles = auth()->user()->loginRole;
        $base_role = null;

        foreach($roles as $role){
            if($role->base){
                $base_role = strtolower($role->role->name);
            }
        }

        return $base_role;
    }


?>