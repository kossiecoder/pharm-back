<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberStatController extends Controller
{
    public function index(Member $member, Request $request)
    {
        $result = $request->has('year') ? $member->getMonthlyStat($request->year) : $member->getYearlyStat();

        return response()->json([
            'result' => $result
        ], Response::HTTP_OK);
    }
}
