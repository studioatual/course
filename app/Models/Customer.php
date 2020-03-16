<?php

namespace Course\Models;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'id',
        'name',
        'cpf_cnpj',
        'rg_ie',
        'email',
        'password',
        'hash',
        'last_access',
    ];
}