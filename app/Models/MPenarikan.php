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
        'id_nasabah'        => 'required|is_natural_no_zero|greater_than[0]|is_not_unique[nasabah.id]',
        'id_teller'         => 'required|is_natural_no_zero|greater_than[0]|is_not_unique[teller.id]',
        'nominal'           => 'required|is_natural_no_zero|greater_than[0]',
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
            'is_natural_no_zero'    => 'Nominal harus berupa angka bulat diatas 0',
            'greater_than'          => 'Nominal minimal 0',
        ],
    ];

    // Callbacks
    protected $beforeInsert   = ['cb_insert_tanggal_penarikan'];

    public function cb_insert_tanggal_penarikan(array $data)
    {
        $data['data']['tanggal_penarikan'] = date('Y-m-d H:i:s');

        return $data;
    }
}
