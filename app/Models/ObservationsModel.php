<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationsModel extends Model
{
    use HasFactory;

    protected $table = 'observations';

    protected $fillable = [
        'costumer_id',
        'observation',
        'created_at',
        'updated_at',
    ];
}
