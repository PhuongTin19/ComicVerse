<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name', 'description', 'status','slug_comic','image','category_id'
    ];
    // If primary key in database is id, then no need to define
    // protected $primarykey = 'id';
    protected $table = 'comic';

    public function categorycomic(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function comicchapter(){
        return $this->hasMany('App\Models\Comic','comic_id','id');
    }
}
