<?php

namespace App\Filters;

class ProductFilter extends BaseFilter
{
    public function price($value)
    {
        $priceFilterValues = explode('-', $value);
        return $this->builder->whereBetween('price', [$priceFilterValues[0], $priceFilterValues[1]]);
    }

    public function defaultFilter($filter, $value)
    {
        $filterValues = explode(',', $value);
        return $this->builder->whereHas('values', function ($q) use ($filter, $filterValues) {
            $q->whereIn('slug', $filterValues);
            $q->whereHas('filter', function ($query) use ($filter) {
                $query->where('slug', $filter);
            });
        });
    }

    public function sort($value)
    {
        if($value == 'rating') {
            return $this->builder->orderByViewsCount();
        } else if($value == 'asc') {
            return $this->builder->orderBy('price');
        } else if($value == 'desc') {
            return $this->builder->orderByDesc('price');
        }
    }
}
