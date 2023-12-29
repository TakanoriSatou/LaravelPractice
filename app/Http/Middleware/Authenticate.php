<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * 認証情報が確認できない場合の処理
     * (親クラスAuthenticateのメソッドをオーバーライド)
     *
     * @param [type] $request
     * @param array $guards
     * @return void
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $this->redirectToOriginal($request, $guards)
        );
    }

    /**
     * ログイン画面にリダイレクトする
     *
     * @param [type] $request
     * @param array $guards
     * @return void
     */
    protected function redirectToOriginal($request, array $guards)
    {
        foreach ($guards as $guard) {
            if ($guard === 'web') {
                return $request->expectsJson() ? null : route('login');
            }
            if ($guard === 'admin') {
                return route('admin.login');
            } 
        }
    }
}
