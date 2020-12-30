<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ProductsBase extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'products_bases';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'stock',
        'min_stock',
        'max_stock',
        'store_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function productProductTags()
    {
        return $this->hasMany(ProductTag::class, 'product_id', 'id');
    }

    public function productProductSpecs()
    {
        return $this->hasMany(ProductSpec::class, 'product_id', 'id');
    }

    public function productItems()
    {
        return $this->hasMany(Item::class, 'product_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
