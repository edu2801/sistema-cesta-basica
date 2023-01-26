<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'costumer_id',
        'street',
        'neighborhood',
        'number',
        'city',
        'state',
        'cep',
        'complement',
        'reference',
        'created_at',
        'updated_at',
    ];
}
