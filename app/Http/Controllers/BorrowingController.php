<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;

class BorrowingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function lend(Request $req)
    {
        Borrowing::create([
            'book_id' => $req->input('book_id'),
            'member_id' => $req->input('member_id'),
        ]);
        $book = Book::findOrFail($req->input('book_id'));
        $req->session()->flash('message',__('borrowing.lend', ['book_name' => $book->name]));
        return response()->json([
            'ms' => 'Ok',
        ]);
    }
    public function returnBook(Request $req)
    {
        $borrowing = Borrowing::findOrFail($req->input('borrowing_id'));
        $borrowing->returned = date('Y-m-d h:i:s');
        $borrowing->save();
        $book = Book::findOrFail($borrowing->book_id);
        $req->session()->flash('message',__('borrowing.return', ['book_name' => $book->name]));
        return response()->json([
            'ms' => 'Ok',
        ]);
    }
}
