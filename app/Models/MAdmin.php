<?php

namespace App\Models;

class MAdmin extends BaseUserModel
{
    protected $table            = 'admin';
    protected $allowedFields    = [
        'username',
        'password',
        'terakhir_login'
    ];

    // Validation
    protected $validationRules      = [
        'id'            => 'permit_empty|is_natural_no_zero',
        'username'      => 'required|alpha_dash|min_length[5]|max_length[255]|is_unique[admin.username,id,{id}]',
        'password'      => 'required|min_length[5]|max_length[255]',
    ];
    protected $validationMessages   = [
        'id'            => [
            'is_natural_no_zero'    => 'ID harus berupa angka dan lebih dari 0',
        ],
        'username'      => [
            'required'      => 'Username wajib diisi',
            'alpha_dash'    => 'Username hanya boleh berisi huruf, angka, underscore, dan dash',
            'min_length'    => 'Username minimal 5 karakter',
            'max_length'    => 'Username maksimal 255 karakter',
            'is_unique'     => 'Username sudah digunakan',
        ],
        'password'      => [
            'required'      => 'Password wajib diisi',
            'min_length'    => 'Password minimal 5 karakter',
            'max_length'    => 'Password maksimal 255 karakter',
        ],
    ];

    // Callbacks
    protected $beforeInsert   = ['cb_hash_password'];
}
