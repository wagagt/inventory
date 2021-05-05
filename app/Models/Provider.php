<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Provider extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'providers';

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
        'contact_name',
        'contact_email',
        'contact_phone',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function providerProductsBases()
    {
        return $this->belongsToMany(ProductsBase::class);
    }

    public function getFullProviderInfo()
    {
        return "{$this->name}, {$this->contact_name}";
    }

}
