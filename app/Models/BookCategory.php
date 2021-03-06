<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCategory extends Model
{
    use SoftDeletes;

    protected $table = 'book_categorys';
    protected $guarded = [];

    public function books(){
        return $this->hasMany('App\Models\Book', 'book_category_id');
    }
}
