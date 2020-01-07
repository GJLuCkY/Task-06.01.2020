<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table = 'filters';

    protected $fillable = ['name', 'slug'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function values() {
        return $this->hasMany(Value::class, 'filter_id');
    }
}
