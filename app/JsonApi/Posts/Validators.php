<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\JsonApi\Contracts\Validators\RelationshipsValidatorInterface;
use CloudCreativity\LaravelJsonApi\Validators\AbstractValidatorProvider;
use Illuminate\Contracts\Validation\Validator;

class Validators extends AbstractValidatorProvider
{

    /**
     * @var string
     */
    protected $resourceType = Schema::RESOURCE_TYPE;

    /**
     * Get the rules to validate the attributes.
     *
     * @param Post|null $record
     *      the record being updated, or null if one is being created.
     * @return array
     */
    protected function attributeRules($record = null)
    {
        // The JSON API spec says the client does not have to send all attributes for an update request, so
        // if the record already exists we need to include a 'sometimes' before required.
        $required = $record ? 'sometimes|required' : 'required';
        $slugUnique = 'unique:posts,slug';

        if ($record) {
            $slugUnique .= ',' . $record->getKey();
        }

        return [
            'title' => "$required|string|between:1,255",
            'content' => "$required|string|min:1",
            'slug' => "$required|alpha_dash|$slugUnique",
        ];
    }

    /**
     * Define the rules to validate relationships.
     *
     * @param RelationshipsValidatorInterface $relationships
     * @param Post|null $record
     */
    protected function relationshipRules(RelationshipsValidatorInterface $relationships, $record = null)
    {
        $relationships->hasOne('author', 'people', is_null($record), false);
    }

    /**
     * Define the rules to validate the filter query param.
     *
     * @return array
     */
    protected function filterRules()
    {
        return [
            'title' => 'string|min:1',
            'slug' => 'sometimes|required|alpha_dash',
        ];
    }

}
