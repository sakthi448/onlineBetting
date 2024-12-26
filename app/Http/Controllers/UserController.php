<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    
    public function getAllUsers(Request $request)
    {
        $query = User::where('role_id', 2);
    
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->has('email') && $request->email) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
    
        if ($request->has('bonus_status') && $request->bonus_status) {
            $bonusStatus = $request->bonus_status == 'Yes' ? 1 : 0;
            $query->where('bonus_status', $bonusStatus);
        }
    
        $users = $query->get();
        
        return DataTables::of($users)
            ->addColumn('bonus_status', function ($user) {
                return $user->bonus_status == 1 ? 'Yes' : 'No';
            })
            ->addColumn('wallet', function ($user) {
                return '₹' . ($user->total_amount > 0 ? $user->total_amount : 0);
            })
            ->rawColumns(['bonus_status', 'wallet'])
            ->make(true);
    }    
    
}
