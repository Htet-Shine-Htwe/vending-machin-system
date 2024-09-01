<?php

namespace App\Traits\Scopes;

trait ProductScope
{
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', $search . '%');
        });


       $query->when($filters['sort'] ?? null, function ($query) use ($filters) {


            $query->when($filters['sort'] == "price_asc", function ($query) {
                $query->orderBy('price', 'asc');
            });

            $query->when( $filters['sort'] == "price_desc" , function ($query) {
                $query->orderBy('price', 'desc');
            });

            $query->when( $filters['sort'] == "quantity_asc" , function ($query) {
                $query->orderBy('quantity_available', 'asc');
            });

            $query->when( $filters['sort'] == "quantity_desc" , function ($query) {
                $query->orderBy('quantity_available', 'desc');
            });
        });

        return $query;
    }
}
