<?php

namespace App\JsonApi\V1\Money;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'money';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
            'amount' => $resource->amount,
            'wallet_id' => $resource->wallet_id,
            'currency_id' => $resource->currency_id
        ];
    }

    public function getRelationships($money, $isPrimary, array $includeRelationships)
    {
        return [
            'wallet' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA =>function()use($money){
                    return $money->wallet;
                }
            ],
            'currency' => [
                self::SHOW_RELATED => false,
                self::SHOW_SELF => true,
                self::DATA => function() use ($money) {
                    return $money->currency;
                }
            ],
        ];
    }
}
