<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_number',
        'cif_number',
        'address',
        'email',
        'date_of_birth',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Relasi: Satu Customer bisa punya banyak Account
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

}
