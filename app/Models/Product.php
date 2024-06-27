<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'is_new',
        'is_popular',
        'product_images',
    ];

    /**
     * Cast attributes to appropriate types.
     *
     * @var array
     */
    protected $casts = [
        'is_new' => 'boolean',
        'is_popular' => 'boolean',
    ];

    /**
     * Get the URL for the product's main image.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if ($this->product_images) {
            $images = explode(',', $this->product_images);
            return asset('storage/images/' . $images[0]);
        }
        return null;
    }

    // Define relationships, scopes, or other methods as needed
}
