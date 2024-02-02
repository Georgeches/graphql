<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

final readonly class ProductResolver
{
    /** @param  array{}  $args */
    public function update($_, array $args)
    {
        $product = Product::find($args['id']);
        $product->update($args);
        return $product;
    }
}