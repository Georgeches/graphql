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
        if(isset($args['id'])){
            $user = User::find($args['id']);

            return $user;
        }

        $users = User::all();
        foreach($users as $user){
            if($user->email === $args['email']){
                return $user;
            }
        }
    }
}