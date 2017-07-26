<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\Tokens;
use App\Token;
use CloudCreativity\JsonApi\Contracts\Http\ApiInterface;
use CloudCreativity\JsonApi\Contracts\Http\Requests\RequestInterface as JsonApiRequest;
use CloudCreativity\JsonApi\Http\Responses\ErrorResponse;
use CloudCreativity\LaravelJsonApi\Http\Responses\ReplyTrait;
use Config;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TokensController extends Controller
{

    use ReplyTrait;

    /**
     * @var Tokens\Hydrator
     */
    private $hydrator;

    /**
     * TokensController constructor.
     *
     * @param Tokens\Hydrator $hydrator
     */
    public function __construct(Tokens\Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
        $this->middleware('auth:jwt', ['except' => 'create']);
    }

    /**
     * Get the guard to be used during authentication.
     * Overrides default Laravel method to get the 'jwt' guard
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('jwt');
    }

    /**
     * Login
     *
     * @param JsonApiRequest $request
     * @return mixed
     */
    public function create(JsonApiRequest $request)
    {
        $resource_attributes = $request->getDocument()->getResource()->getAttributes();
        $credentials = [
            'email' => $resource_attributes->email,
            'password' => $resource_attributes->password,
        ];

        $token = new Token();
        if ($token->id = $this->guard()->attempt($credentials)) {
            $token->token_type = 'bearer';
            $token->expires_in = Config::get('jwt.ttl') * 60;
            return $this->reply()->created($token);
        } else {
            // Incorrect login details
            // TODO: Give a proper error response message
            $errors = new ErrorResponse([], 422);
            return $this->reply()->errors($errors);
        }
    }

    /**
     * Logout
     *
     * @param JsonApiRequest $request
     * @return mixed
     */
    public function delete(JsonApiRequest $request)
    {
        $this->guard()->logout();

        return $this->reply()->noContent();
    }
}
