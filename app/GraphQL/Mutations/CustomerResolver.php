<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Customer;

final readonly class CustomerResolver
{
    /** @param  array{}  $args */

    public function new($_, array $args)
    {
        $newCustomer = new Customer($args);
        $newCustomer->save();

        return $newCustomer;
    }

    public function update($_, array $args)
    {
        $customer = Customer::find($args['id']);
        $customer->update($args);

        return $customer;
    }

    public function delete($_, array $args)
    {
        $customer = Customer::find($args['id']);

        if($customer->delete()){
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
