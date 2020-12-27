<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ProductSpec extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'product_specs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'value',
        'inputy_type',
        'product_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const INPUTY_TYPE_SELECT = [
        'text'      => 'Text',
        'int'       => 'Integer',
        'float'     => 'Float',
        'money'     => 'Money',
        'date'      => 'Date',
        'time'      => 'Time',
        'date_time' => 'Date/Time',
        'image'     => 'Image',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function product()
    {
        return $this->belongsTo(ProductsBase::class, 'product_id');
    }
}
