<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\SortableTrait;

class Entry extends Model
{
    use HasFactory;
    use SortableTrait;
    use SoftDeletes;

    protected $fillable = [
        'value',
        'value',
        'category_id',
        'image',
        'url',
        'done',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
