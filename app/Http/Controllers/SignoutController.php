<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignoutController extends Controller
{
    /**
     * Signout 기본 메소드
     */
    public function __invoke()
    {
        Auth::user()->update([
            'api_token' => null
        ]);

        return response()->noContent();
    }
}
