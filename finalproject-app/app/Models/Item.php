<?php

// Project: finalproject-app/items
// Author: Jacob Dimoff
// Date: 4/12/23
// Filename: Item.php
// Purpose: a Model to act as a DTO for the items table in the servers database.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    // These are all the fields of the items table minus the id
    protected $fillable = [
        "category_id",
        "title",
        "description",
        "price",
        "quantity",
        "SKU",

        // This not the actual image but the filepath
        "picture"
    ];
    
    // laravel adds timestamps to new query, in order to get rid of these, set the timestamps to zero.
    public $timestamps = false;
    
    // This function is used to determine that the relationship between items and categories is that items belongs to catagories since it has a foreign key.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
