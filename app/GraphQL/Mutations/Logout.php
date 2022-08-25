<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

final class Logout
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $guard = Auth::guard(Arr::first(config('sanctum.guard', ['web'])));

        /**
         * Since we successfully logged in, this can no longer be `null`.
         *
         * @var \App\Models\User $user
         */
        $user = $guard->user();
        $guard->logout();

        return $user;
    }
}
