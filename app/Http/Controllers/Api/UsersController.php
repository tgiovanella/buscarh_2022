<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\User as AppUser;


class UsersController extends Controller
{
    public function usersLike($term = null) {
        return AppUser::select('users.id', DB::raw('CONCAT(users.name," - ",users.email) as text'))
        ->when(isset($term) && !empty($term), function ($q) use ($term) {
            return $q->where('users.name','like', '%'.$term.'%');
        })
        ->get();
    }
}
