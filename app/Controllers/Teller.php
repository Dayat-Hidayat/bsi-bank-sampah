<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Teller extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // cek role di session
        // jika role tidak sama dengan teller atau admin, maka
        // tampilkan halaman error 403 (404)
        if ($this->user_role != 'teller' && $this->user_role != 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function index()
    {
        $teller_list = $this->teller_model->findAll();

        $data = [
            'title' => 'Daftar Teller',
            'teller_list' => $teller_list
        ];

        return view('teller/index', $data);
    }

    public function create()
    {
        if ($this->user_role != "admin") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('get')) {
            // tampilkan halaman form untuk menambah data teller baru
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

    public function ubah(int $id)
    {
        // Jika role bukan admin dan bukan teller yang bersangkutan, maka
        // tampilkan halaman error 403 (404)
        if ($this->user_role != 'admin' && $this->user_role != 'teller' && $this->logged_in_user['id'] != $id) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('get')) {
            // tampilkan halaman form khusus teller

            // ambil data dari database pada table teller berdasarkan id

            // jika data tidak ditemukan, maka tampilkan error 404
        } else if ($this->request->is('post')) {
            // PROSES UBAH DATA
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

    public function hapus(int $id)
    {
        // Jika role bukan admin, maka
        // tampilkan halaman error 403 (404)
        if ($this->user_role != 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // PROSES HAPUS DATA
        // ambil data dari database pada table teller berdasarkan id

        // jika data tidak ditemukan, maka tampilkan error 404

        // jika data ditemukan, maka hapus data dari database

        // tampilkan pesan sukses menggunakan flashdata

        // redirect ke halaman list
    }
}
