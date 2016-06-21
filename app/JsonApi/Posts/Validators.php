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
        $slugUnique = 'unique:posts,slug';

        if ($record) {
            $slugUnique .= ',' . $record->getKey();
        }

        return [
            'title' => 'string|between:1,255',
            'content' => 'string|min:1',
            'slug' => "alpha_dash|{$slugUnique}",
        ];
    }

    /**
     * Configure conditional attribute validation rules.
     *
     * In this example, we add a 'required' rule to the attributes that are required
     * if we are creating a resource.
     *
     * @param Validator $validator
     *      the attributes validator instance.
     * @param Post|null $record
     *      the record being updated, or null if one is being created.
     */
    protected function conditionalAttributes(Validator $validator, $record = null)
    {
        $validator->sometimes(['title', 'content', 'slug'], 'required', function () use ($record) {
            return is_null($record);
        });
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
