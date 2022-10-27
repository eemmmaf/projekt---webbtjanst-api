<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'shelf',
        'category_id'
    ];


    //Använder belongsto till Category. Ett-till-många
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
