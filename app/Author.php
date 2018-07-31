<?php

namespace App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany('App\Book', 'author_id');
    }
    public static function boot()
    {
    parent::boot();
    self::deleting(function($author) {
    if ($author->books->count() > 0) {
    $html = 'Penulis tidak bisa dihapus karena masih memiliki buku : ';
    $html .= '<ul>';
    foreach ($author->books as $book) {
    $html .= "<li>$book->title</li>";
    }
    $html .= '</ul>';
    Session::flash("flash_notification", [
    "level"=>"danger",
    "message"=>$html
    ]);
    return false;
    }
    });
}
   
}


