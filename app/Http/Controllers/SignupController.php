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
     * @param SignupRequest $request
     * @return UserResource
     */
    public function __invoke(SignupRequest $request)
    {
        $this->user->name = $request->name;
        $this->user->nickname = $request->nickname;
        $this->user->password = bcrypt($request->password);
        $this->user->phone_number = $request->phone_number;
        $this->user->email = $request->email;
        $this->user->gender = $request->gender;
        $this->user->save();

        return new UserResource($this->user);
    }
}
