<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
// use App\Filters\PermissionFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DB;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->permission) {
            return $this->savePermission($request);
        }

        $data['role_permissions'] = [];
        if ($request->role_id) {
            $data['role_permissions'] = Permission::leftJoin('roles', 'roles.id', '=', 'permissions.role_id')->where('permissions.role_id', $request->role_id)->select('permissions.*', 'roles.name')->get();

            // echo '<pre>'; dd($data['role_permissions']); echo '</pre>';
        }

        $routeCollection = Route::getRoutes();

        $info = [];
        foreach ($routeCollection as $value) {
            $dat = json_decode( json_encode($value), true)['action'];

            $uses = isset($dat['uses']) ? $dat['uses'] : 'n/a';
            if( is_array($uses) || strpos($uses, 'App\Http\Controllers') === false){
                continue;
            }

            $uses = str_replace('App\Http\Controllers\\', '', $uses);
            $uses = str_replace('Auth\\', '', $uses);
            $uses = str_replace('Controller', '', $uses);
            $info[] = $uses;
        }

        foreach ($info as $key => $value) {
            if ( ! $value) {                
                unset($info[$key]);
            }
        }

        $exceptControllers = ['ConfirmPassword', 'ForgotPassword', 'Login', 'Register', 'ResetPassword', 'Verification'];

        $modules = [];
        foreach ($info as $key => $value) {
            
            $controller =  explode('@', $value)[0];

            $action = explode('@', $value)[1];

            if ( ! in_array($controller, $modules) && ! in_array($controller, $exceptControllers)) {

                $modules[] = $controller;
            }
        }

        $module_permissions = [];
        foreach ($modules as $key_module => $value_module) {

            $ddd = [];
            foreach ($info as $key_info => $value_info) {
                if ( explode('@', $value_info)[0] == $value_module) {

                    // $ddd[] = str_replace('_', ' ', implode(' ', preg_split('/(?=[A-Z])/', explode('@', $value_info)[1] )) );

                    $ddd[] = explode('@', $value_info)[1];
                }
            }

            $module_permissions[$key_module]['name_title'] = str_replace('_', '', implode(' ', preg_split('/(?=[A-Z])/', $value_module )) );
            $module_permissions[$key_module]['name'] = $value_module;

            $module_permissions[$key_module]['data'] = array_unique($ddd);
        }

        $data['modules'] = $modules;
        $data['module_permissions'] = $module_permissions;
        $data['info'] = array_unique($info);

        $data['roles'] = Role::orderBy('id', 'asc')->get();
        $data['permissions'] = Permission::orderBy('permi_id', 'desc')->latest()->get();
        return view('permissions.index', $data);
    }
    public function savePermission($request)
    {
        Permission::where(['role_id'=>$request->role_id])->delete();

        if ($request->module) {
            
            foreach ($request->module as $key => $value) {
                $store = [];
                $desc = [];
                foreach ($request->module_sub[$key] as $key_desc => $value_desc) {
                    $desc[] = $key_desc;                
                }
                $store['role_id'] = $request->role_id;
                $store['permi_module'] = $key;
                $store['permi_desc'] = json_encode($desc);

                Permission::create($store);
            }
        }

        return redirect()->back()->withSuccess('Permission saved successfully!');
    }

    public function create()
    {
        return view('permissions.create');
    }    

    public function edit($id)
    {
        $data['permission'] = Permission::findOrFail($id);
        return view('permissions.edit', $data);
    }    

    public function store(Request $request)
    {
        $requests = $request->all();
        $requests['user_id'] = \Auth::user()->id;

        $permission = Permission::create($requests);
        
        return redirect()->route('permission')->with('success', sprintf('Permission created successfully'));        
    }

    public function show(Permission $permission)
    {
        return response()->json($permission);
    }

    public function update(Permission $permission, Request $request)
    {
        $permission->update($request->all());
        
        return redirect()->route('permission')->with('success', 'Permission updated successfully');
    }

    public function destroy(Permission $permission)
    {
        try {

            DB::beginTransaction();

            $permission->delete();
            
            DB::commit();

        } catch (\Exception $e) {
            
            DB::rollBack();
            // echo '<pre>'; dd($e); echo '</pre>';
            
            return response()->json(['status'=>'error', 'message'=>'Permission deleting failed!']);
        }

        return response()->json(['status'=>'success', 'message'=>'Permission deleted successfully']);
    }
}
