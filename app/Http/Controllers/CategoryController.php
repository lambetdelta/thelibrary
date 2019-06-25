<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list(){
        $this->resData('categorys', BookCategory::withTrashed()->limit(5000)->get());
        return view('category.list', $this->data);
    }
    public function add(Request $req){
        $req->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        BookCategory::create([
            'name' => $req->input('name'),
            'description' => $req->input('description'),
        ]);
        $req->session()->flash('message',__('category.add'));
        return redirect()->route('category_list');
    }
    public function viewAdd(){
        return view('category.add', $this->data);
    }
    public function edit(Request $req){
        $req->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        $category = BookCategory::withTrashed()->findOrFail($req->input('id'));
        $category->name =  $req->input('name');
        $category->description =  $req->input('description');
        $category->save();
        $req->session()->flash('message',__('category.edit'));
        return redirect()->route('category_list');
    }
    public function viewEdit(Request $req, $id){
        $this->resData('category', BookCategory::withTrashed()->findOrFail($id));
        return view('category.edit', $this->data);
    }
    public function delete(Request $req){
        $member = BookCategory::withTrashed()->findOrFail($req->input('id'));
        $member->forceDelete();
        $req->session()->flash('message',__('category.delete'));
        return redirect()->route('category_list');
    }
    public function viewDelete(Request $req, $id){
        $this->resData('category', BookCategory::withTrashed()->findOrFail($id));
        return view('category.delete', $this->data);
    }
}
