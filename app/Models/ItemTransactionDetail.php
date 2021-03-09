<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ItemTransactionDetail extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'item_transaction_detail';


    protected $fillable = [
        'transaction_detail_id',
        'item_id'
    ];

    public $timestamps = false;
}
