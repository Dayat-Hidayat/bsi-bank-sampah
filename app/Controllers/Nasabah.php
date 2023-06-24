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
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }
    }

    function index()
    {
        // $nasabah_list = $this->nasabah_model->where('id', $this->logged_in_user['id'])->findAll();

        $nasabah_list = $this->nasabah_model->findAll();

        $data = [
            'title' => 'Daftar Nasabah',
            'nasabah_list' => $nasabah_list
        ];

        return view('nasabah/index', $data);
    }
}
