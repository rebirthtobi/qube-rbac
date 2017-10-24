<?php

namespace RebirthTobi\QubeRbac\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case'POST':
                return [
                    'name' => 'required|string|max:255|unique:permissions,name',
                    'controller' => 'required|string|max:255|unique:permissions,controller',
                    'description' => 'nullable|string|max:255'
                ];
            case 'PATCH':
                return [
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('permissions')->ignore($this->route('id')),
                    ],
                    'controller' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('permissions')->ignore($this->route('id')),
                    ],
                    'description'    => 'nullable|string|max:255',
                ];
            default:
                break;
        }
    }
}
