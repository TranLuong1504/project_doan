<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/3/2020
 * Time: 5:13 PM
 */

namespace Modules\Admin\Http\Requests\Role;


use Modules\Admin\Repository\Role\RoleRepositoryInterface;
use Pearl\RequestValidate\RequestAbstract;

class RoleEditRequest extends RequestAbstract
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $role = $this->roleRepository->firstById($this->id);

        return [
            'name'              => 'required|string|max:50|min:2|unique:roles,name,'. $role->id,
            'identifier_name'   => 'required|string|max:50|min:2|unique:roles,identifier_name,'. $role->id,
            'description'       => 'required|string|min:5'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required'             => trans('messages.validate.name') . trans('messages.validate.required'),
            'name.string'               => trans('messages.validate.name') . trans('messages.validate.string'),
            'name.max'                  => trans('messages.validate.name') . trans('messages.validate.max') . 50,
            'name.min'                  => trans('messages.validate.name') . trans('messages.validate.min') . 2,
            'name.unique'               => trans('messages.validate.name') . trans('messages.validate.name_unique'),
            'identifier_name.required'  => trans('messages.validate.identifier_name') . trans('messages.validate.required'),
            'identifier_name.string'    => trans('messages.validate.identifier_name') . trans('messages.validate.string'),
            'identifier_name.max'       => trans('messages.validate.identifier_name') . trans('messages.validate.max') . 50,
            'identifier_name.min'       => trans('messages.validate.identifier_name') . trans('messages.validate.min') . 2,
            'identifier_name.unique'    => trans('messages.validate.identifier_name') . trans('messages.validate.name_unique'),
            'description.required'      => trans('messages.validate.description') . trans('messages.validate.required'),
            'description.string'        => trans('messages.validate.description') . trans('messages.validate.string'),
            'description.min'           => trans('messages.validate.description') . trans('messages.validate.min') . 5,
        ];
    }
}
