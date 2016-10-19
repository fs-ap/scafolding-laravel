<?php

return [

    'middlewares' => [
        'authentication' => \App\Http\Middleware\Authorization\AuthGuardMiddleware::class,
        'authorization' => \App\Http\Middleware\AuthGuardMiddleware::class,
    ],

    'routes' => [
        'parser' => \App\Acl\Parser\RouteParser::class,
    ],

    'authorization' => [
        'guard' => \App\Acl\Guard\Authorization\AuthorizationGuard::class,
        'loginPage' => 'login',
        'chooseTentantPage' => 'chooseTenant',
        'tenant_session_key' => 'multitenant_tenant',
    ],
    'tenant' => \App\Entities\Tenant::class,
    'authorizable' => \App\User::class,
    	

];
