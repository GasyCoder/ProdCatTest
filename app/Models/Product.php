<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'category_id',
    ];

    protected $casts = [
        'price' => 'float', 
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Générer automatiquement le slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                $originalSlug = $product->slug;
                
                while (static::where('slug', $product->slug)->exists()) {
                    $product->slug = $originalSlug . '-' . rand(100, 999);
                }
            }
        });
    }

    // prix formaté
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' €';
    }
}