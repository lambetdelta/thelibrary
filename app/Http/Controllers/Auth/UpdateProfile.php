<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Rules\CurrentPassword;
use App\Http\Requests\UpdateProfile as UpdateProfileReq;

class UpdateProfile extends Controller
{
	public function __construct(){
    	parent::__construct();
    }
	public function viewUpdatePassword(Request $request){
		return view('auth.update_password', $this->data);
	}
	public function updatePassword(Request $request){
		$user = Auth::user();
		$request->validate([
			'current-password' =>['required','max:255',new CurrentPassword],
		    'password' => 'required|max:255',
		    'repeat-password' => 'required|same:password',
		]);
		$user->password = bcrypt($request->password);
		$user->save();
		$request->session()->flash('message',__('ms.update_password'));
        return redirect()->route('home');
	}
	public function viewUpdateProfile(Request $request){
        $this->resData('user', Auth::user());
		return view('auth.update_profile',$this->data);
	}
	public function updateProfile(UpdateProfileReq $request){
		$user = Auth::user();
		$user->name = $request->name_user;
		$user->email = $request->email;
		$user->save();
        $request->session()->flash('message',__('ms.update_profile'));
        return redirect()->route('home');
	}
}
