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
        if ($this->user_role != 'nasabah') {
            // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            return redirect('auth/login');
        }
    }

    function index()
    {
        return view('nasabah/index');
    }
}
