<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

final class LoginEmployee
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];

        return auth()->guard('api-employee')->attempt($credentials);
    }
}
