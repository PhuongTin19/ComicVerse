<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title', 'description', 'status','content','comic_id','slug_chapter'
    ];
    // If primary key in database is id, then no need to define
    // protected $primarykey = 'id';
    protected $table = 'chapter';

    public function comicchapter(){
        return $this->belongsTo('App\Models\Comic','comic_id','id');
    }
}
