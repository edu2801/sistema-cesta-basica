<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitationModel extends Model
{
    use HasFactory;

    protected $table = 'habitation';

    protected $fillable = [
        'costumer_id',
        'situation',
        'type',
        'financing_details',
        'ownership',
        'condition',
        'value',
        'created_at',
        'updated_at',
    ];
}
