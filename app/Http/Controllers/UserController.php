<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\UserCreateRequest;
use App\Interface\Services\UserServiceInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userServiceInterface;

    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userServiceInterface = $userServiceInterface;
    }

    //user-list
    public function userList()
    {
        $userList = $this->userServiceInterface->getuserList();
        $userCount = $userList->total();
        return view('user.user_list', compact('userList', 'userCount'));

    }

    public function userSearch()
    {
        $userList = $this->userServiceInterface->getSearchList();
        $userCount = $userList->total();
        return view('user.user_list', compact('userList', 'userCount'));

    }

    //user-delete
    public function userDelete(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();
        return redirect()->back();
    }

    public function userCreateConfirm(UserCreateRequest $request)
    {
        $data = $this->userServiceInterface->getData($request);
        $last_id = $this->userServiceInterface->getLastID($request);
        $filename = $this->userServiceInterface->getProfilePhoto($request);
        $data['profile'] = $filename;
        $createConfirm = $data;
        return view('user.user_create_confirm', compact('createConfirm', 'last_id'));
    }

    //user-store
    public function userStore(Request $request)
    {
        $store = $this->userServiceInterface->getData($request);
        $pw = bcrypt($request->password);
        $store['password'] = $pw;
        User::create($store);
        return redirect()->route('user#userList');
    }

    //user-edit
    public function userEdit($id)
    {
        $edit = User::where('id', $id)->first();
        return view('user.user_edit', compact('edit'));
    }

    public function userEditConfirm(Request $request, $id, $profile)
    {
        $data = $this->userServiceInterface->getData($request);
        $filename = $this->userServiceInterface->getProfilePhotoEdit($request, $id);

        if ($request->hasFile('profile')) {
            $data['profile'] = $filename;
        } else {
            $data['profile'] = $profile;
        }
        $editConfirm = $data;
        return view('user.user_edit_confirm', compact('editConfirm', 'id'));
    }

    //userUpdate
    public function userUpdate(Request $request, $id)
    {
        $updateData = $this->userServiceInterface->getData($request);
        if (Hash::needsRehash($request->password)) {
            $pw = bcrypt($request->password);
            $updateData['password'] = $pw;
        }
        User::where('id', $id)->update($updateData);
        return redirect()->route('user#userList');
    }

    //user-profile
    public function userProfile($id)
    {
        $profile = User::where('id', $id)->first();
        return view('user.user_profile', compact('profile', 'id'));
    }

    //password change
    public function passwordChange(PasswordChangeRequest $request)
    {
        if (Hash::check($request->currentPwd, Auth::user()->password)) {
            $this->userServiceInterface->changePassword($request);
            return redirect('/home');
        }
    }

    //home
    public function homeCount()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $userPostCount = Auth::user()->posts->count();
        return view('home', compact('userCount', 'postCount', 'userPostCount'));
    }

}