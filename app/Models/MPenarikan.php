<?php

namespace App\Models;

use CodeIgniter\Model;

class MPenarikan extends Model
{
    protected $table            = 'penarikan';
    protected $allowedFields    = [
        'id_nasabah',
        'id_teller',
        'nominal',
        'tanggal_penarikan',
    ];

    // Validation
    protected $validationRules      = [
        'id_nasabah'        => 'required|numeric|greater_than[0]|is_not_unique[nasabah.id]',
        'id_teller'         => 'required|numeric|greater_than[0]|is_not_unique[teller.id]',
        'nominal'           => 'required|greater_than[0]',
    ];
    protected $validationMessages   = [
        'id_nasabah'        => [
            'required'              => 'Nasabah wajib diisi',
            'numeric'               => 'Nasabah harus berupa angka',
            'greater_than'          => 'Nasabah harus lebih dari 0',
            'is_not_unique'         => 'Nasabah tidak ditemukan',
        ],
        'id_teller'         => [
            'required'              => 'Teller wajib diisi',
            'numeric'               => 'Teller harus berupa angka',
            'greater_than'          => 'Teller harus lebih dari 0',
            'is_not_unique'         => 'Teller tidak ditemukan',
        ],
        'nominal'           => [
            'required'              => 'Nominal wajib diisi',
            'greater_than_equal_to' => 'Nominal minimal 0',
        ],
    ];

    // Callbacks
    protected $beforeInsert   = ['cb_insert_tanggal_penarikan', 'cb_bulat_kebawah_nominal'];
    protected $beforeUpdate   = ['cb_bulat_kebawah_nominal'];

    public function cb_insert_tanggal_penarikan(array $data)
    {
        $data['data']['tanggal_penarikan'] = date('Y-m-d H:i:s');

        return $data;
    }

    public function cb_bulat_kebawah_nominal(array $data)
    {
        if (isset($data['data']['nominal'])) {
            $data['data']['nominal'] = floor($data['data']['nominal']);
        }
        return $data;
    }
}
