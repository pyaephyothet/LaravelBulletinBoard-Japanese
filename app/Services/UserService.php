<?php

namespace App\Services;

use App\Interface\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function getuserList()
    {
        $userList = DB::table('users as user')
            ->join('users as create_user', 'user.create_user_id', '=', 'create_user.id')
            ->join('users as updated_user', 'user.updated_user_id', '=', 'updated_user.id')
            ->select('user.*', 'create_user.name as create_user', 'updated_user.name as updated_user')
            ->orderBy('created_at', 'desc')
            ->whereNull('user.deleted_at')
            ->paginate(5);
        return $userList;
    }

    public function getSearchList()
    {
        $searchList = DB::table('users as user')
            ->when(request('searchName'), function ($query) {
                $query->where('user.name', 'Like', '%' . request('searchName') . '%');
            })
            ->when(request('searchEmail'), function ($query) {
                $query->where('user.email', 'Like', '%' . request('searchEmail') . '%');
            })
            ->when(in_array(request('searchRole'), [0, 1]), function ($query) {
                $query->where('user.role', 'Like', '%' . request('searchRole') . '%');
            })
            ->when(request('searchCreatedFrom'), function ($query) {
                $searchFrom = date('Y-m-d', strtotime(request('searchFrom')));
                $query->where('user.created_at', 'Like', '%' . $searchFrom . '%');
            })
            ->when(request('searchCreatedTo'), function ($query) {
                $searchTo = date('Y-m-d', strtotime(request('searchTo')));
                $query->where('user.updated_at', 'Like', '%' . $searchTo . '%');
            })
            ->join('users as create_user', 'user.create_user_id', '=', 'create_user.id')
            ->join('users as updated_user', 'user.updated_user_id', '=', 'updated_user.id')
            ->select('user.*', 'create_user.name as create_user', 'updated_user.name as updated_user')
            ->orderBy('created_at', 'desc')
            ->whereNull('user.deleted_at')
            ->paginate(5);

        return $searchList;
    }

    public function getLastID()
    {
        return $last_id = User::latest()->withTrashed()->first()->id + 1;
    }

    public function getProfilePhoto($request)
    {
        $last_id = User::latest()->withTrashed()->first()->id + 1;
        if ($request->hasFile('profile')) {
            $filename = $last_id . '_' . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->storeAs('public/' . $last_id, $filename);
            return $filename;
        }
    }

    public function getProfilePhotoEdit($request, $id)
    {
        if ($request->hasFile('profile')) {
            $filename = $id . '_' . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->storeAs('public/' . $id, $filename);
            return $filename;
        }
    }

    public function changePassword($request)
    {
        return DB::transaction(function () use ($request) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->newPwd);
            $user->updated_user_id = Auth::user()->id;
            $user->save();
        });
    }

    //get respective data input from blade files
    public function getData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $request->profile,
            'password' => $request->password,
            'create_user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id,
        ];
    }

}