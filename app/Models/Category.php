<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name', 'description', 'status','slug_category'
    ];
    // If primary key in database is id, then no need to define
    // protected $primarykey = 'id';
    protected $table = 'category';
}
