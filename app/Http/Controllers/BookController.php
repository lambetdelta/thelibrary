<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list(){
        $this->resData('books', Book::select('books.name', 'books.author', 'books.published_date',
            'books.book_category_id', 'books.created_at', 'books.updated_at',
            DB::raw('book_categorys.name AS category'),
            DB::raw('(SELECT id FROM borrowings WHERE book_id = books.id AND returned IS NULL LIMIT 1) AS borrowing'))
            ->join('book_categorys', 'book_categorys.id', '=', 'books.book_category_id')
            ->limit(5000)
            ->get());
        return view('book.list', $this->data);
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
        $req->session()->flash('message',__('book.add'));
        return redirect()->route('book_list');
    }
    public function viewAdd(){
        return view('book.add', $this->data);
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
        $req->session()->flash('message',__('book.edit'));
        return redirect()->route('book_list');
    }
    public function viewEdit(Request $req, $id){
        $this->resData('book', Member::findOrFail($id));
        return view('book.edit', $this->data);
    }
    public function delete(Request $req){
        $member = Member::findOrFail($req->input('id'));
        $member->delete();
        $req->session()->flash('message',__('book.delete'));
        return redirect()->route('book_list');
    }
    public function viewDelete(Request $req, $id){
        $this->resData('book', Member::findOrFail($id));
        return view('book.delete', $this->data);
    }
}
