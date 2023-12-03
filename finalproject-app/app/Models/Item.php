<?php

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
    
    public $timestamps = false;
    
    // This function is used to determine that the relationship between items and categories is that items belongs to catagories since it has a foreign key.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
