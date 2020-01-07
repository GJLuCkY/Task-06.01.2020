<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
