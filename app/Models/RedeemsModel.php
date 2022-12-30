<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeemsModel extends Model
{
    use HasFactory;

    protected $table = 'redeems';

    protected $fillable = [
        'id',
        'costumer_id',
        'responsible_id',
        'responsible_name',
        'created_at',
        'updated_at',
    ];

}
