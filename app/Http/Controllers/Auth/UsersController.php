<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\EditUserRequest;

class UsersController extends Controller{

    public function list(Request $req){
        $this->resData('users', User::all());
        return view('auth.list', $this->data);
    }
    public function viewEditUser(Request $req, $id){
        $this->resData('user', User::findOrFail($id));
        return view('auth.edit_user', $this->data);
    }
    public function editUser(EditUserRequest $req){
        $user = User::findOrFail($req->input('id'));
        $user->name = $req->input('name_user');
        $user->email = $req->input('email');
        $user->active = $req->input('active');
        $user->save();
        $req->session()->flash('message',__('ms.update_user'));
        return redirect()->route('list_users');
    }
}
