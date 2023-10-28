<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

final class LoginCompany
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

        return auth()->guard('api-company')->attempt($credentials);
    }
}
