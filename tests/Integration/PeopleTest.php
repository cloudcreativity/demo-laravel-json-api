<?php

namespace App\Tests\Integration;

use App\Person;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PeopleTestCase extends TestCase
{

    use DatabaseTransactions;

    /**
     * Test the index route.
     */
    public function testIndex()
    {
        $uri = $this->linkTo()->index('api-v1::people');

        $this->jsonApi('GET', $uri)
            ->assertIndexResponse('people');
    }

    /**
     * Test the create resource route.
     */
    public function testCreate()
    {
        /** @var Person $model */
        $model = factory(Person::class)->make();
        $uri = $this->linkTo()->index('api-v1::people');

        $data = [
            'type' => 'people',
            'attributes' => [
                'first-name' => $model->first_name,
                'surname' => $model->surname
            ],
        ];

        $id = $this
            ->jsonApi('POST', $uri, ['data' => $data])
            ->assertCreateResponse('people', $data['attributes']);

        $this->assertModelCreated($model, $id, ['first_name', 'surname']);
    }

    /**
     * Test the read resource route.
     */
    public function testRead()
    {
        /** @var Person $model */
        $model = factory(Person::class)->create();
        $uri = $this->linkTo()->resource('api-v1::people', $model->getKey());

        $this->jsonApi('GET', $uri)
            ->assertReadResponse('people', $model->getKey(), [
                'first-name' => $model->first_name,
                'surname' => $model->surname,
            ]);
    }

    /**
     * Test the update resource route.
     */
    public function testUpdate()
    {
        /** @var Person $model */
        $model = factory(Person::class)->create();
        $uri = $this->linkTo()->resource('api-v1::people', $model->getKey());
        $firstName = 'ABC';

        $data = [
            'type' => 'people',
            'id' => $model->getKey(),
            'attributes' => [
                'first-name' => $firstName,
            ],
        ];

        $this->jsonApi('PATCH', $uri, ['data' => $data])
            ->assertUpdateResponse('people', $model->getKey(), [
                'first-name' => $firstName,
                'surname' => $model->surname,
            ])
            ->assertModelPatched($model, ['first_name' => $firstName], ['surname']);
    }

    /**
     * Test the delete resource route.
     */
    public function testDelete()
    {
        /** @var Person $model */
        $model = factory(Person::class)->create();
        $uri = $this->linkTo()->resource('api-v1::people', $model->getKey());

        $this->jsonApi('DELETE', $uri)
            ->assertDeleteResponse()
            ->assertModelDeleted($model);
    }
}
