<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable=['category_id','name','description','price','quantity'];

    public function category()
    {
        return $this->hasMany(ItemCategory::class,'item_id','id');
    }


}
