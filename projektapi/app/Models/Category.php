<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryname',
        'categorydescription'
    ];

    //Använder hasMany till Products. Ett-till-många
    public function products() {
        return $this->hasMany(Products::class);
    }
}
