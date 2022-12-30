<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostumersModel extends Model
{
    use HasFactory;

    protected $table = 'costumers';

    protected $fillable = [
        'name',
        'phone',
        'birth_date',
        'marital_status',
        'rg',
        'cpf',
        'schooling',
        'occupation',
        'salary',
        'cadastro_unico',
        'bolsa_familia',
        'prestacao_continuada',
        'renda_cidada',
        'cesta_basica',
        'family_income',
        'last_redeem',
        'created_at',
        'updated_at',
    ];

    public static function getDashboardData()
    {
        return self::select(
            'costumers.id',
            'costumers.name',
            'costumers.cpf',
            'costumers.birth_date',
            'costumers.phone',
            'costumers.last_redeem',
        )->get();
    }
}
