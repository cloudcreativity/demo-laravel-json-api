<?php

namespace Tests\Feature;

use App\SiteRepository;
use App\User;
use Laravel\Passport\Passport;

class SitesTest extends TestCase
{

    /**
     * @var string
     */
    protected $resourceType = 'sites';

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        Passport::actingAs(factory(User::class)->create());
    }

    public function testCreate()
    {
        // ensure 'my-site' doesn't exist before creating it...
        app(SiteRepository::class)->remove('my-site');

        $data = [
            'type' => 'sites',
            'id' => 'my-site',
            'attributes' => [
                'name' => 'My Blog',
                'domain' => 'http://blog.example.com',
            ],
        ];

        $id = $this->doCreate($data)->assertCreatedWithId($data);
        $this->assertEquals('my-site', $id);

        return $data;
    }

    /**
     * @param array $expected
     * @depends testCreate
     */
    public function testRead(array $expected)
    {
        $this->doRead('my-site')->assertRead($expected);
    }

    /**
     * @depends testCreate
     */
    public function testUpdate()
    {
        $data = [
            'type' => 'sites',
            'id' => 'my-site',
            'attributes' => [
                'name' => 'My New Blog',
            ],
        ];

        $expected = $data;
        $expected['attributes']['domain'] = 'http://blog.example.com';

        $this->doUpdate($data)->assertUpdated($expected);
    }

    /**
     * @depends testCreate
     */
    public function testDelete()
    {
        $this->doDelete('my-site')->assertDeleted();
        $this->assertNull(app(SiteRepository::class)->find('my-site'));
    }

}
