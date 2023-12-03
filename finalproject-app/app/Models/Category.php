<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // fillable array allows for the name to be held by the model class when a value is submitted.
    protected $fillable = ["name"];
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
