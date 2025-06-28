<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyGroupModel extends Model
{
    use HasFactory;

    protected $table = 'family_group';

    protected $fillable = [
        'costumer_id',
        'name',
        'kinship',
        'birth_date',
        'age',
        'income_source',
        'income_value',
        'schooling',
        'occupation',
        'salary',
        'created_at',
        'updated_at',
    ];
}
