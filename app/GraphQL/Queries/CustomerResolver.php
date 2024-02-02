<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Customer;

final readonly class CustomerResolver
{
    /** @param  array{}  $args */
    public function paginate($_, array $args)
    {
        $page = $args['page'];
        $count = $args['count'];
        $customers = Customer::query()
            ->orderBy('id', 'asc')
            ->paginate($count, ['*'], 'page', $page);
        
        return $customers;
    }

    public function show($_, array $args)
    {
        if(isset($args['id'])){
            $customer = Customer::find($args['id']);
            return $customer;
        }

        $customers = Customer::all();
        foreach($customers as $customer){
            if($customer->email === $args['email']){
                return $customer;
            }
        }
    }
}