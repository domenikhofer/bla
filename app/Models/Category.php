<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use SoftDeletes;

    protected $fillable = ['name', 'parent_id', 'category_type_id', 'emoji'];


    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->where('deleted_at', null);
    }

    public function allChildren()
    {
        $children = $this->children()->get()->toArray();
        foreach ($children as &$child) {
            $child['children'] = $this->find($child['id'])->allChildren();
        }
        return $children;
    }
}
