<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Store extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'stores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'zone',
        'city',
        'department',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function storeProductsBases()
    {
        return $this->hasMany(ProductsBase::class, 'store_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
