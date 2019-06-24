<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\RoleUser;
use App\Http\Requests\EditUserRequest;

class UsersController extends Controller{

    public function list(Request $req){
        $this->resData('users', User::all());
        $this->resData('roles_users', RoleUser::select('role_user.user_id', 'role_user.role_id',
            'roles.display_name')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->get()
        );
        return view('auth.list', $this->data);
    }
    public function viewEditUser(Request $req, $id){
        $this->resData('user', User::findOrFail($id));
        $this->resData('roles', \App\Role::orderBy('name','asc')->get());
        return view('auth.edit_user', $this->data);
    }
    public function editUser(EditUserRequest $req){
        $user = User::findOrFail($req->input('id'));
        $user->name = $req->input('name');
        $user->username = $req->input('username');
        $user->email = $req->input('email');
        $user->active = $req->input('active');
        $user->save();
        if(count($req->roles) > 0)
            $this->updateRoles($user, $req->input('roles'));
        $req->session()->flash('message',__('ms.update_user'));
        return redirect()->route('list_users');
    }
    private function updateRoles($user, $roles){
        RoleUser::where('user_id', $user->id)->delete();
        foreach ($roles as $id) {
            $role = \App\Role::where('id', '=', $id)->first();
            if ($role !== null)
                $user->roles()->attach($role->id); // id only
        }
        $user->save();
    }
}
