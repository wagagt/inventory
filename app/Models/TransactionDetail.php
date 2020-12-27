<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class TransactionDetail extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'transaction_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'quantity',
        'transaction_id',
        'producto_id',
        'product_stock',
        'productname_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function producto()
    {
        return $this->belongsTo(ProductsBase::class, 'producto_id');
    }

    public function productname()
    {
        return $this->belongsTo(Product::class, 'productname_id');
    }
}
