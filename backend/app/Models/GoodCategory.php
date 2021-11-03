<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
class GoodCategories extends Pivot
{
    use HasFactory;
    public function goods()
    {
        return $this->belongsTo(Good::class);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
