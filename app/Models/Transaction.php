<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'outlet_id',
        'member_id',
        'invoice_code',
        'status',
        'tanggal',
        'batas_waktu',
        'dibayar',
        'diskon',
        'total_harga',
        'tanggal_bayar'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'batas_waktu' => 'date',
        'tanggal_bayar' => 'date',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Hitung total setelah diskon
    public function getTotalAfterDiscountAttribute()
    {
        return $this->total_harga - ($this->total_harga * $this->diskon / 100);
    }
}