<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->product_slug = Str::of($model->product_name)->slug('-');
        });

        self::updating(function ($model) {
            $model->product_slug = Str::of($model->product_name)->slug('-');
        });
    }
    
    protected $fillable = [
        'category_id', 'subcategory_id', 'product_name','product_description','price','product_image','availblity','status'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo(Category::class,'subcategory_id','id');
    }
}
