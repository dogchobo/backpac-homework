<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\User as UserResource;

class SignupController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * SignupController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Signup 기본 메소드
     *
     * @param SignupRequest $request
     * @return UserResource
     */
    public function __invoke(SignupRequest $request)
    {
        return new UserResource($this->user->create($request->validated()));
    }
}
