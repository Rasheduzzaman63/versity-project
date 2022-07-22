<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Route;
use Auth;
class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role_permissions = \App\Models\Role::join('permissions', 'permissions.role_id', '=', 'roles.id')->get();
        $request->session()->put('role_permissions', $role_permissions);

        $route = Route::getRoutes()->match($request);
        $currentroute = explode('@', class_basename($route->getActionName()) );
        $controller = $currentroute[0];
        $method = $currentroute[1];
        $permission = hasPermission($controller, $method);
        if ( ! $permission ) {
            if ($request->ajax()) {
                return response()->json(['status'=>'error', 'message'=>'Permission denied!']);
            }else{
                return redirect('/')->with('error', 'Permission denied!');
            }
        }

        return $next($request);
    }
}
