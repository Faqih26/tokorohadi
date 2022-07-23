<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $fillable=[
        'name','photo','slug','users_id'
    ];

    protected $hidden =[

    ];
    //public $timestamps =false;
    public function user()
    {
        return $this->hasOne(User::class,'id','users_id');
    }
}
