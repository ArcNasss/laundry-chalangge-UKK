<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];

    public function Outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function Member(){
        return $this->belongsTo(Member::class);
    }

    public function transactionDetails (){
        return $this->hasMany(TransactionDetail::class);
    }
}
