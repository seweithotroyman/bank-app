<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'account_number',
        'account_type',
        'balance',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
