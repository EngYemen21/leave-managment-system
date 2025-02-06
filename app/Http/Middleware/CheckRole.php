<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
          // تحقق مما إذا كان المستخدم مسجلاً الدخول
    if (!Auth::guard('employee')->check()) {
        return redirect()->route('login'); // أو أي مسار آخر
    }

    // الحصول على المستخدم الحالي
    $employee = Auth::guard('employee')->user();

    // تحقق من الدور
    // if (!$employee->hasRole($role)) {
    //     return redirect()->route('login'); // أو أي مسار آخر
    // }

    return $next($request);
    }
}
