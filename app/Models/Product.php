<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'details',
        'image',
        'status',
    ];

    public function category_details()
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
    
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }
    
    public function product_drinks()
    {
        return $this->hasMany(ProductDrink::class, 'product_id', 'id');
    }
    
    public function product_flavours()
    {
        return $this->hasMany(ProductFlavour::class, 'product_id', 'id');
    }
    
    public function product_sauces()
    {
        return $this->hasMany(ProductSauce::class, 'product_id', 'id');
    }
    
    public function product_sides()
    {
        return $this->hasMany(ProductSide::class, 'product_id', 'id');
    }
    
    public function product_removables()
    {
        return $this->hasMany(ProductRemovable::class, 'product_id', 'id');
    }
}
