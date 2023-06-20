<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Setoran extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    public function index()
    {
        // tampilan halaman list setoran
        // jika role admin, maka tampilkan semua data setoran
        // jika role teller atau user, maka tampilkan data setoran yang memiliki id teller atau user tersebut
        if ($this->user_role == 'teller') {
            $data_setoran = $this->setoran_model->where('id_teller', $this->logged_in_user['id'])->findAll();
        } else if ($this->user_role == 'nasabah') {
            $data_setoran = $this->setoran_model->where('id_nasabah', $this->logged_in_user['id'])->findAll();
        } else {
            $data_setoran = $this->setoran_model->findAll();
        }

        // ambil data dari database pada tabel setoran

        // tampilkan data ke view
    }

    public function create()
    {
        if ($this->user_role != 'teller' && $this->user_role != 'nasabah') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('get')) {
            // tampilkan halaman form untuk menambah data setoran baru
        } else if ($this->request->is('post')) {
            // PROSES TAMBAH DATA
            // ambil data dari form

            // validasi data

            // jika data tidak valid, maka tampilkan error menggunakan flashdata
            // dan redirect ke halaman form kembali

            // jika data valid, maka simpan data ke database

            // tampilkan pesan sukses menggunakan flashdata

            // redirect ke halaman list
        } else {
            // jika bukan get atau post, maka tampilkan error 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
