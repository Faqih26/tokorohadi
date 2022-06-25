<?php

namespace App\Models;

use App\Product;
use App\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable=[
        "transactions_id",
        "products_id",
        "price",
        "shipping_status",
        "resi",
        "code"
    ];

    protected $hidden =[

    ];

    //public $timestamps =false;

    public function product(){
        return $this->hasOne(Product::class,'id','products_id');
    }
    public function transaction(){
        return $this->hasOne(Transaction::class,'id','transactions_id',);
    }
}
