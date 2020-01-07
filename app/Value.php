<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'values';

    protected $fillable = ['name', 'slug', 'filter_id'];

    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
