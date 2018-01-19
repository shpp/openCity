<?php

namespace App\Http;

use Illuminate\Auth\Middleware\Authorize;
use App\Http\Middleware\BannedMiddleware;
use Zizaco\Entrust\Middleware\EntrustRole;
use Illuminate\Auth\Middleware\Authenticate;
use Zizaco\Entrust\Middleware\EntrustAbility;
use Illuminate\Session\Middleware\StartSession;
use Zizaco\Entrust\Middleware\EntrustPermission;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            Middleware\EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            Middleware\VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'can' => Authorize::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'throttle' => ThrottleRequests::class,
        'role' => EntrustRole::class,
        'permission' => EntrustPermission::class,
        'ability' => EntrustAbility::class,
        'banned' => BannedMiddleware::class,
    ];
}
