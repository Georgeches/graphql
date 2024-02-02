<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;

final readonly class UserResolver
{
    /** @param  array{}  $args */

    public function new($_, array $args)
    {
        $password = password_hash($args['password'], PASSWORD_DEFAULT);
        $newUser = new User($args);
        $newUser->password = $password;
        $newUser->save();

        return $newUser;
    }

    public function update($_, array $args)
    {
        $user = User::findOrFail($args['id']);
        if(!empty($args['password'])){
            $args['password'] = password_hash($args['password'], PASSWORD_DEFAULT);
        }
        $user->update($args);

        return $user;
    }

    public function delete($_, array $args)
    {
        $user = User::findOrFail($args['id']);

        if($user->delete()){
            return [
                'status' => '200',
                'message' => 'User deleted'
            ];
        }
        return [
            'status' => '400',
            'message' => 'User not deleted'
        ];
    }
}
