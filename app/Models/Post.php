<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['user_id','title','content','photo','slug'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
