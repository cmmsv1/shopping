<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public static function getArrayChildren($id)
    {
        $category_chidren = Category::where('parent_id', $id)->get();
        $array_id_children = array();
        foreach ($category_chidren as $value) {
            array_push($array_id_children, $value->id);
        }
        return $array_id_children;
    }
    public static function tree()
    {
        $allCategories = Category::get();

        $rootCategories = $allCategories->where('parent_id', 0);

        self::formatTree($rootCategories, $allCategories);

        return $rootCategories;
    }

    private static function formatTree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id)->values();

            if ($category->children->isNotEmpty()) {
                self::formatTree($category->children, $allCategories);
            }
        }
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) { // before delete() method call this
            $category->products()->delete();
            // do the rest of the cleanup...
        });
    }
}
