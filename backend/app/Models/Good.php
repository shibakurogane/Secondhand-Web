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
        'seller_id',
        'purchaser_id',
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
        return $this->hasMany(GoodCategory::class);
    }
}
