<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Auth;

class CheckPermission implements Middleware{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if($this->userHasAccessTo($request)) {
            view()->share('currentUser', $request->user());
            return $next($request);
        }

        //return redirect()->route('home');
        return abort(403,"you don't have access to this page");
	}

    /*
	|--------------------------------------------------------------------------
	| Additional helper methods for the handle method
	|--------------------------------------------------------------------------
	*/

    /**
     * Checks if user has access to this requested route
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Boolean true if has permission otherwise false
     */
    protected function userHasAccessTo($request)
    {
        if(Auth::user())
            return $this->hasPermission($request);

        return redirect()->guest('auth/login');

    }

    /**
     * hasPermission Check if user has requested route permimssion
     *
     * @param  \Illuminate\Http\Request $request
     * @return Boolean true if has permission otherwise false
     */
    protected function hasPermission($request)
    {
        $required = $this->requiredPermission($request);

        return !$this->forbiddenRoute($request) && $request->user()->can($required);
    }

    /**
     * Extract required permission from requested route
     *
     * @param  \Illuminate\Http\Request  $request
     * @return String permission_slug connected to the Route
     */
    protected function requiredPermission($request)
    {
        $action = $request->route()->getAction();

        //if the permission isn't specified .. then get it from the route name
//        if(!isset($action['permission']))
//            $action['permission'] = explode('.',$action['as'])[0];

        return isset($action['permission']) ? explode('|', $action['permission']) : null;
    }

    /**
     * Check if current route is hidden to current user role
     *
     * @param  \Illuminate\Http\Request $request
     * @return Boolean true/false
     */
    protected function forbiddenRoute($request)
    {
        $action = $request->route()->getAction();

        if(isset($action['except'])) {

            return $action['except'] == $request->user()->role->slug;
        }

        return false;
    }

}
