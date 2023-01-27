<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthSituationModel extends Model
{
    use HasFactory;

    protected $table = 'health_situation';

    protected $fillable = [
        'costumer_id',
        'chronic_diseases',
        'vices',
        'created_at',
        'updated_at',
    ];
}
