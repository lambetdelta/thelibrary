<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\BookCategory', 'book_category_id');
    }
    public function borrowing(){
        return $this->hasMany('App\Models\Borrowing', 'book_id');
    }
}
