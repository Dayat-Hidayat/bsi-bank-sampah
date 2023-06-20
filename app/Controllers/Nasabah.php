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

        $data = [
            'title' => 'Daftar Nasabah',
            'nasabah' => $nasabah
        ];

        return view('nasabah/index', $data);
    }
}
