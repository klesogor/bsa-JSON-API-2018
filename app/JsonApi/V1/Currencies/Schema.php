<?php

namespace App\JsonApi\V1\Currencies;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'currencies';

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
            'name' => $resource->name
        ];
    }

    public function getRelationships($currency, $isPrimary, array $includeRelationships)
    {
        return [
            'money' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA =>function()use($currency){
                    return $currency->money;
                }
            ]
        ];
    }
}
