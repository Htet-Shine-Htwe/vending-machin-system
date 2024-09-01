<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_amount',
        'user_id',
        'address',
        'city',
        'state',
        'phone_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->reference = 'REF' . time();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProductsAttribute($value)
    {
        return json_decode($value);
    }

    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = json_encode($value);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_products', 'transaction_id', 'product_id')
        ->withPivot('quantity', 'price');
    }



}
