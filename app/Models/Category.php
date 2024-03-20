<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

}
