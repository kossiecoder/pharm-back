<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Member extends Model
{
    public function getYearlyStat()
    {
        return self::orderBy('joined_date')->get()->groupBy(function ($item) {
            return Carbon::parse($item->joined_date)->format('Y');
        })->map->count();
    }

    public function getMonthlyStat(int $year)
    {
        return self::whereYear('joined_date', $year)->orderBy('joined_date')->get()->groupBy(function ($item) {
            return Carbon::parse($item->joined_date)->format('m');
        })->map->count();
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->firstname !== null) {
            $query = $query->where('firstname', 'LIKE', '%' . $request->firstname . '%');
        }

        if ($request->surname !== null) {
            $query = $query->where('surname', 'LIKE', '%' . $request->surname . '%');
        }

        if ($request->email !== null) {
            $query = $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        return $query;
    }
}
