<?php

namespace App;

use App\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';
    protected $primaryKey = 'id';

    protected $fillable = ['prod_cat_id'];

    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

}
