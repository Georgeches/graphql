<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

final readonly class productResolver
{
    /** @param  array{}  $args */
    public function update($_, array $args)
    {
        $customer = Customer::find($args['id']);
        $customer->update($args);
        return $customer;
    }
}