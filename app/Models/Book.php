<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function libraries()
    {
        return $this->hasMany(Library::class, 'book_id', 'id');
    }
}
