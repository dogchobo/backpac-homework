<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Resources\UserWithApiToken as UserResource;

class SigninController extends Controller
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
     * Signin 기본 메소드
     *
     * @param SigninRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function __invoke(SigninRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'message' => '이메일 주소 또는 비밀번호가 올바르지 않습니다.'
            ], 401);
        }

        return new UserResource($this->user->apiTokenRenewByEmail($request->email));
    }
}
