<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): User
    {
        // TODO implement the resolver
        // Plain Laravel: Auth::guard()
        // Laravel Sanctum
        // $guard = Auth::guard(config('sanctum.guard', 'web'));
        $guard = Auth::guard(Arr::first(config('sanctum.guard', ['web'])));

        if (!$guard->attempt($args)) {
            throw new Error('Invalid credentials.');
        }

        /**
         * Since we successfully logged in, this can no longer be `null`.
         *
         * @var \App\Models\User $user
         */
        $user = $guard->user();

        return $user;
    }
}
