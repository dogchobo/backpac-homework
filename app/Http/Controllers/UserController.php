<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Models\Order;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserWithLastOrder as UserWithLastOrderResource;
use App\Http\Resources\Order as OrderResource;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Order
     */
    private $order;

    /**
     * UserController constructor.
     * @param User $user
     * @param Order $order
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
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
        return OrderResource::collection($this->order
            ->userId($id)
            ->get()
        );
    }
}
