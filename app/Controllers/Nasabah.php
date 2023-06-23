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
        // Ini Bisa
        $nasabah_list = $this->nasabah_model->where('id', $this->logged_in_user['id'])->findAll();
        // $username_login = $this->nasabah_model->where('id', $this->logged_in_user['username'])->findAll();


        // $username_login = $this->nasabah_model->get_where('username', $this->logged_in_user['id'])->row_array();
        $username_login = $this->nasabah_model->where('username', $this->logged_in_user['id'])->findAll();
        // $username_login = 'test';

        // Tapi Kalo Ini Ada Bug yang mana nasabah selalu muncul di setiap login
        // $nasabah_list = $this->nasabah_model->find($this->logged_in_user);

        $data = [
            'title' => 'Daftar Nasabah',
            'nasabah_list' => $nasabah_list,
            'username_login' => $username_login
        ];

        return view('nasabah/index', $data);
    }
}
