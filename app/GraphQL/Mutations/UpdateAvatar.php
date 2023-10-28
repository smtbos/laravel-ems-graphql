<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Str;

final class UpdateAvatar
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        /** @var \Illuminate\Foundation\Auth\User $user */
        $user = auth()->user();

        /** Get table name */
        $userTable = $user->getTable();

        /** Get avatar path */
        switch ($userTable) {
            case 'users':
                $userId = $user->id;
                $avatarPath = 'users/' . $userId . '/avatars';
                break;
            case 'companies':
                $companyId = $user->id;
                $avatarPath = 'companies/' . $companyId . '/avatars';
                break;
            case 'employees':
                $companyId = $user->company->id;
                $employeeId = $user->id;
                $avatarPath = 'companies/' . $companyId . '/employees/' . $employeeId . '/avatars';
                break;
        }

        /** Store avatar */
        $avatarPath = $args['avatar']->storePublicly('public/' . $avatarPath);

        /** Replace public with storage */
        $avatarPath = Str::replaceFirst('public/', 'storage/', $avatarPath);

        /** Update avatar */
        $user->update([
            'avatar' => $avatarPath,
        ]);

        /** Get avatar path */
        $avatarPath = asset($avatarPath);

        /** Return avatar path */
        return $user->avatar_url;
    }
}
