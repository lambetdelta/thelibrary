<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookRequest;
use App\Models\Member;

class BookController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list(){
        $this->resData('books', Book::select('books.name', 'books.id', 'books.author',
            'books.published_date','books.book_category_id', 'books.created_at', 'books.updated_at',
            DB::raw('book_categorys.name AS category'),
            DB::raw('(SELECT id FROM borrowings WHERE book_id = books.id AND returned IS NULL LIMIT 1) AS borrowing'))
            ->join('book_categorys', 'book_categorys.id', '=', 'books.book_category_id')
            ->limit(5000)
            ->get());
        $this->resData('members', Member::get()->toArray());
        return view('book.list', $this->data);
    }
    public function add(BookRequest $req){
        Book::create([
            'name' => $req->input('name'),
            'author' => $req->input('author'),
            'published_date' => formatDate($req->input('published_date'), 'Y-m-d'),
            'book_category_id' => $req->input('book_category_id'),
        ]);
        $req->session()->flash('message',__('book.add'));
        return redirect()->route('book_list');
    }
    public function viewAdd(){
        $this->resData('categorys', BookCategory::orderBy('name')->get());
        return view('book.add', $this->data);
    }
    public function edit(BookRequest $req){
        $book = Book::findOrFail($req->input('id'));
        $book->name = $req->input('name');
        $book->author = $req->input('author');
        $book->published_date = formatDate($req->input('published_date'), 'Y-m-d');
        $book->book_category_id = $req->input('book_category_id');
        $book->save();
        $req->session()->flash('message',__('book.edit'));
        return redirect()->route('book_list');
    }
    public function viewEdit(Request $req, $id){
        $this->resData('book', Book::select('books.name','books.id', 'books.author', 'books.published_date',
            'books.book_category_id', 'books.created_at', 'books.updated_at',
            DB::raw('book_categorys.name AS category'),
            DB::raw('(SELECT id FROM borrowings WHERE book_id = books.id AND returned IS NULL LIMIT 1) AS borrowing'))
            ->join('book_categorys', 'book_categorys.id', '=', 'books.book_category_id')
            ->firstOrFail($id));
        $this->resData('categorys', BookCategory::orderBy('name')->get());
        return view('book.edit', $this->data);
    }
    public function delete(Request $req){
        $book = Book::findOrFail($req->input('id'));
        $book->delete();
        $req->session()->flash('message',__('book.delete'));
        return redirect()->route('book_list');
    }
    public function viewDelete(Request $req, $id){
        $this->resData('book', Book::select('books.name','books.id', 'books.author', 'books.published_date',
        'books.book_category_id', 'books.created_at', 'books.updated_at',
        DB::raw('book_categorys.name AS category'),
        DB::raw('(SELECT id FROM borrowings WHERE book_id = books.id AND returned IS NULL LIMIT 1) AS borrowing'))
        ->join('book_categorys', 'book_categorys.id', '=', 'books.book_category_id')
        ->firstOrFail($id));
        $this->resData('categorys', BookCategory::orderBy('name')->get());
        return view('book.delete', $this->data);
    }
}
