<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'user_id',
        'post_id',
        'detail',
        'price',
        'sold_time',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'good_categories','good_id','category_id');
    }
}
