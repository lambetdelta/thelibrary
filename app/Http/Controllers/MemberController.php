<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;


class MemberController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list(){
        $this->resData('members', Member::limit(5000)->get());
        return view('member.list', $this->data);
    }
    public function add(Request $req){
        $req->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);
        Member::create([
            'first_name' => $req->input('first_name'),
            'last_name' => $req->input('last_name'),
        ]);
        $req->session()->flash('message',__('member.add'));
        return redirect()->route('member_list');
    }
    public function viewAdd(){
        return view('member.add', $this->data);
    }
    public function edit(Request $req){
        $req->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);
        $member = Member::findOrFail($req->input('id'));
        $member->first_name =  $req->input('first_name');
        $member->last_name =  $req->input('last_name');
        $member->save();
        $req->session()->flash('message',__('member.edit'));
        return redirect()->route('member_list');
    }
    public function viewEdit(Request $req, $id){
        $this->resData('member', Member::findOrFail($id));
        return view('member.edit', $this->data);
    }
    public function delete(Request $req){
        $member = Member::findOrFail($req->input('id'));
        $member->delete();
        $req->session()->flash('message',__('member.delete'));
        return redirect()->route('member_list');
    }
    public function viewDelete(Request $req, $id){
        $this->resData('member', Member::findOrFail($id));
        return view('member.delete', $this->data);
    }
}
