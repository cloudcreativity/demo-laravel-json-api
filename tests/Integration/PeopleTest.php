<?php

namespace App\Tests\Integration;

use App\Person;

class PeopleTestCase extends TestCase
{

    /**
     * Test the search route.
     */
    public function testSearch()
    {
        // ensure there is at least one person in the database
        $this->person();

        $this->doSearch()
            ->assertSearchResponse();
    }

    /**
     * Test searching for specific ids
     */
    public function testSearchById()
    {
        $models = factory(Person::class, 2)->create();
        // This person should not be returned in the results
        $this->person();

        $this->doSearchById($models)
            ->assertSearchByIdResponse($models);
    }

    /**
     * Test the create resource route.
     */
    public function testCreate()
    {
        $model = $this->person(false);

        $data = [
            'type' => 'people',
            'attributes' => [
                'first-name' => $model->first_name,
                'surname' => $model->surname
            ],
        ];

        $id = $this
            ->doCreate($data)
            ->assertCreateResponse($data);

        $this->assertModelCreated($model, $id, ['first_name', 'surname']);
    }

    /**
     * Test the read resource route.
     */
    public function testRead()
    {
        $model = $this->person();

        $data = [
            'type' => 'people',
            'id' => $model->getKey(),
            'attributes' => [
                'first-name' => $model->first_name,
                'surname' => $model->surname,
            ],
            'relationships' => [
                'posts',
                'comments',
            ],
        ];

        $this->doRead($model)
            ->assertReadResponse($data);
    }

    /**
     * Test the update resource route.
     */
    public function testUpdate()
    {
        $model = $this->person();

        $data = [
            'type' => 'people',
            'id' => (string) $model->getKey(),
            'attributes' => [
                'first-name' => 'Foo',
            ],
        ];

        $this->doUpdate($data)
            ->assertUpdateResponse($data)
            ->assertModelPatched($model, $data['attributes'], ['surname']);
    }

    /**
     * Test the delete resource route.
     */
    public function testDelete()
    {
        $model = $this->person();

        $this->doDelete($model)
            ->assertDeleteResponse()
            ->assertModelDeleted($model);
    }

    /**
     * @inheritdoc
     */
    protected function getResourceType()
    {
        return 'people';
    }

    /**
     * This is just a helper so that we get a type hinted person model back.
     *
     * @param bool $create
     * @return Person
     */
    private function person($create = true)
    {
        $builder = factory(Person::class);

        return $create ? $builder->create() : $builder->make();
    }

}
