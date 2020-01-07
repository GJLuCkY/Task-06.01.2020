<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ProductFilter;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function values()
    {
        return $this->belongsToMany(Value::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter($query, ProductFilter $filters)
    {
        $filters->apply($query);
    }
}
