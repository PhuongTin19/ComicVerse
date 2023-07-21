<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'comment','comic_id','users_id'
    ];
    // If primary key in database is id, then no need to define
    // protected $primarykey = 'id';
    protected $table = 'comment';

    public function comiccomment(){
        return $this->belongsTo('App\Models\Comic','comic_id','id');
    }

    public function usercomment(){
        return $this->belongsTo('App\Models\Comment','users_id','id');
    }
}
