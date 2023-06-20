<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Nasabah extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

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
