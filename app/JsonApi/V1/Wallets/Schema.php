<?php

namespace App\JsonApi\V1\Wallets;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'wallets';

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
            'user_id' => $resource->user_id
        ];
    }

    public function getRelationships($wallet, $isPrimary, array $includeRelationships)
    {
        return [
            'user' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA =>function()use($wallet){
                    return $wallet->user;
                }
            ],
            'money' => [
                self::SHOW_RELATED => false,
                self::SHOW_SELF => true,
                self::DATA => function() use ($wallet) {
                    return $wallet->money;
                }
            ],
        ];
    }
}
