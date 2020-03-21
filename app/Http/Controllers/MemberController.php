<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    public function index(Member $member, Request $request)
    {
        $members = $member->filter($request)->paginate(10);

        return response()->json([
            'result' => $members
        ], Response::HTTP_OK);
    }
}
