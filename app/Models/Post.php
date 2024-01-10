<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','sub_category_id','title','description','img'];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function sub_category():BelongsTo{
        return $this->belongsTo(SubCategory::class);
    }
}
