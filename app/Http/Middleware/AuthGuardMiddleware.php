<?php

namespace App\Http\Middleware;

use App\Acl\Guard\Authorization\Exception\AuthorizationWithoutSessionException;
use App\Acl\Guard\Authorization\AuthorizationGuardInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Closure;

class AuthGuardMiddleware implements AuthGuardMiddlewareInterface
{
    protected $guard;

    public function __construct(AuthorizationGuardInterface $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            
            if(!$this->guard->allow()) {
                return redirect($this->guard->getLoginPage());
            }

        } catch (AuthorizationWithoutSessionException $e) {
            return redirect($this->guard->getChooseTenantPage());
        }

        return $next($request);
    }
}
