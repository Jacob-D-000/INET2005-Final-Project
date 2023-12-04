<?php

// Project: finalproject-app/categories
// Author: Jacob Dimoff
// Date: 4/12/23
// Filename: Category.php
// Purpose: a Model to act as a DTO for the category table in the servers database.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // fillable array allows for the name to be held by the model class when a value is submitted.
    protected $fillable = ["name"];

    // laravel adds timestamps to new query, in order to get rid of these, set the timestamps to zero.
    public $timestamps = false;
    
    // Show that relationship between this class and the items class.
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
