<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Nasabah extends BaseController
{
    public function __construct()
    {
        // cek role di session
        // jika role tidak sama dengan nasabah, maka
        // tampilkan halaman error 403 (404)
        // if ($this->user_role != 'nasabah') {
        // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // return redirect('auth');
        // }
    }

    function index()
    {
        $nasabah = $this->nasabah_model->find($this->logged_in_user);
        $setoran = $this->setoran_model->find($this->logged_in_user);
        $kategori = $this->kategori_model->findAll();
        $teller = $this->teller_model->findAll();

        $data = [
            'title' => 'Daftar Nasabah',
            'nasabah' => $nasabah,
            'setoran' => $setoran,
            'kategori' => $kategori,
            'teller' => $teller
        ];

        return view('nasabah/index', $data);
    }
}
