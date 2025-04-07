<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'package_id',
        'qty',
        'harga_satuan',
        'subtotal',
        'message'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    protected static function booted()
    {
        static::saving(function ($detail) {
            if ($detail->package) {
                $detail->harga_satuan = $detail->package->harga;
                $detail->subtotal = $detail->harga_satuan * $detail->qty;
            }
        });
    }
}