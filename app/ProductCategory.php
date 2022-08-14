<?php

namespace App;

use App\ProductDetail;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name','class','price','image','status'];

    public function productdetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
