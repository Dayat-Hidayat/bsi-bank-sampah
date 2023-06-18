<?php

namespace App\Models;

use CodeIgniter\Model;

class MSetoran extends Model
{
    protected $table            = 'setoran';
    protected $allowedFields    = [
        'id_nasabah',
        'id_teller',
        'kategori_sampah',
        'taksiran',
        'berat',
        'nominal',
        'tanggal_setor',
    ];

    // Validation
    protected $validationRules      = [
        'id_nasabah'        => 'required|numeric|greater_than[0]|is_not_unique[nasabah.id]',
        'id_teller'         => 'required|numeric|greater_than[0]|is_not_unique[teller.id]',
        'kategori_sampah'   => 'required|min_length[1]|max_length[255]',
        'taksiran'          => 'required|is_natural|greater_than0]',
        'berat'             => 'required|greater_than[0]',
        'nominal'           => 'required|is_natural|greater_than[0]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $beforeInsert   = ['cb_insert_tanggal_penarikan'];

    public function cb_insert_tanggal_penarikan(array $data)
    {
        $data['data']['tanggal_penarikan'] = date('Y-m-d H:i:s');

        return $data;
    }
}
