<?php

namespace App\Models;

class MTeller extends BaseUserModel
{
    protected $table            = 'teller';
    protected $allowedFields    = [
        'username',
        'password',
        'nama_lengkap',
        'nomor_telepon',
        'email',
        'tanggal_daftar',
        'terakhir_login',
        'is_active',
    ];

    // Validation
    protected $validationRules      = [
        'id'            => 'permit_empty|is_natural_no_zero',
        'username'      => 'required|alpha_dash|min_length[5]|max_length[255]|is_unique[teller.username,id,{id}]',
        'password'      => 'required|min_length[5]|max_length[255]',
        'nama_lengkap'  => 'required|min_length[1]|max_length[255]',
        'nomor_telepon' => 'required|min_length[5]|max_length[255]',
        'email'         => 'required|valid_email|max_length[255]',
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
        'nama_lengkap'  => [
            'required'      => 'Nama lengkap wajib diisi',
            'min_length'    => 'Nama lengkap minimal 1 karakter',
            'max_length'    => 'Nama lengkap maksimal 255 karakter',
        ],
        'nomor_telepon' => [
            'required'      => 'Nomor telepon wajib diisi',
            'min_length'    => 'Nomor telepon minimal 5 karakter',
            'max_length'    => 'Nomor telepon maksimal 255 karakter',
        ],
        'email'         => [
            'required'      => 'Email wajib diisi',
            'valid_email'   => 'Email tidak valid',
            'max_length'    => 'Email maksimal 255 karakter',
        ],
    ];

    // Callbacks
    protected $beforeInsert   = ['cb_hash_password', 'cb_insert_tanggal_daftar'];
    protected $beforeUpdate   = ['cb_hash_password'];
}
