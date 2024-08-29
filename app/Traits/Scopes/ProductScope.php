<?php

namespace App\Traits\Scopes;

trait ProductScope
{
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', $search . '%');
        });

        $query->when($filters['price_asc'] ?? null, function ($query, $min_price) {
            $query->orderBy('price', 'asc');
        });

        $query->when($filters['price_desc'] ?? null, function ($query, $max_price) {
            $query->orderBy('price', 'desc');
        });

        $query->when($filters['quantity_asc'] ?? null, function ($query, $min_quantity) {
            $query->orderBy('quantity_available', 'asc');
        });

        $query->when($filters['quantity_desc'] ?? null, function ($query, $max_quantity) {
            $query->orderBy('quantity_available', 'desc');
        });

        return $query;

    }
}
