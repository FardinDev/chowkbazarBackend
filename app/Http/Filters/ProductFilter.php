<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class ProductFilter extends Filter
{
    
    public function category(string $value = null): Builder
    {
        return $this->builder->whereHas('category', function ($query) use ($value) {
            $query->where('slug', $value);
        });
    }

    
    public function sort(string $value = null): Builder
    {

        $value = \explode('_', $value);

        if (isset($value[0]) && ! Schema::hasColumn('products', $value[0])) {
            return $this->builder;
        }

        return $this->builder->orderBy(
            $value[0] ?? 'id', $value[1] ?? 'desc'
        );
    }
}