<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;

final readonly class UserResolver
{
    /** @param  array{}  $args */
    public function paginate($_, array $args)
    {
        $page = $args['page'];
        $count = $args['count'];
        $users = User::query()
            ->orderBy('id', 'asc')
            ->paginate($count, ['*'], 'page', $page);
        
        return $users;
    }

    public function show($_, array $args)
    {
        $user = User::findOrFail($args['id']);

        return $user;
    }
}