<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $userId = session('loginId');
        if (!$userId) {
            abort(403, 'Not logged in');
        }

        $user = User::find($userId);

        if (!$user || !method_exists($user, 'hasPermission')) {
            abort(403, 'User or permission method not found');
        }

        if ($user->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'You do not have the required permission');
    }
}
