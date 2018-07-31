<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    protected $fillable = ['book_id', 'user_id', 'is_returned'];
    
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    protected $casts = ['is_returned' => 'boolean',];
        public function scopeReturned($query)
        {
            return $query->where('is_returned', 1);
        }
        public function scopeBorrowed($query)
        {
            return $query->where('is_returned', 0);
        }
}
