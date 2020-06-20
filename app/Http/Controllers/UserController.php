<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserWithLastOrder as UserWithLastOrderResource;
use App\Http\Resources\Order as OrderResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 회원 목록 조회 / Param: name-이름, email-이메일 / Paginate
     *
     * @param UserIndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(UserIndexRequest $request)
    {
        return UserWithLastOrderResource::collection($this->user
            ->with([
                'order' => function ($query) {
                    $query->latest();
                }
            ])
            ->when($request->name, function ($query) use ($request) {
                $query->name($request->name);
            })
            ->when($request->email, function ($query) use ($request) {
                $query->email($request->email);
            })
            ->paginate(3)
        );
    }

    /**
     * 단일 회원 조회 / Param: {id}-회원ID
     *
     * @param $id
     * @return UserResource
     */
    public function show($id)
    {
        if (!$this->user->find($id)) {
            throw new NotFoundHttpException('Not Found');
        }

        return new UserResource($this->user->find($id));
    }

    /**
     * 단일 회원 주문 목록 조회 / Param: {id}-회원ID
     *
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function indexOrder($id)
    {
        if (!$this->user->find($id)) {
            throw new NotFoundHttpException('Not Found');
        }

        return OrderResource::collection($this->user->find($id)->orders);
    }
}
