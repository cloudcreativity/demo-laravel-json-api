<?php

namespace App\Tests\Integration;

use App\Token;
use App\User;

class TokensTest extends TestCase
{

    /**
     * Test the create resource route. This is to do a login.
     */
    public function testCreate()
    {
        $random_password = str_random(10);
        $model = factory(User::class)->create(['password' => bcrypt($random_password)]);

        $data = [
            'type' => 'tokens',
            'attributes' => [
                'email' => $model->email,
                'password' => $random_password
            ],
        ];

        $token_response = [
            'type' => 'tokens',
            'attributes' => [
                'token-type' => 'bearer',
                'expires-in' => 3600
            ]
        ];

        $id = $this
            ->jsonApi('POST', '/api/v1/tokens', ['data' => $data])
            ->assertCreateResponse($token_response);
    }

    /**
     * Test the delete resource route. This is to do a logout.
     */
    public function testDelete()
    {
        // Carry out login process to retrieve JWT
        $random_password = str_random(10);
        $model = factory(User::class)->create(['password' => bcrypt($random_password)]);
        $data = [
            'type' => 'tokens',
            'attributes' => [
                'email' => $model->email,
                'password' => $random_password
            ],
        ];

        $token_response = $this
            ->jsonApi('POST', '/api/v1/tokens', ['data' => $data])
            ->decodeResponseJson();
        $jwt = $token_response['data']['id'];

        // Attempt to logout
        $headers = [
            'Authorization' => $jwt
        ];

        dd($this->jsonApi('DELETE', '/api/v1/tokens/' . $jwt, [], $headers));
    }

    /**
     * @inheritdoc
     */
    protected function getResourceType()
    {
        return 'tokens';
    }

    /**
     * This is just a helper so that we get a type hinted token model back.
     *
     * @param bool $create
     * @return Token
     */
    private function token($create = false)
    {
        $builder = factory(Token::class);

        return $create ? $builder->create() : $builder->make();
    }

    /**
     * This is just a helper so that we get a type hinted user model back.
     *
     * @param bool $create
     * @return User
     */
    private function user($create = true)
    {
        $builder = factory(User::class);

        return $create ? $builder->create() : $builder->make();
    }

}
