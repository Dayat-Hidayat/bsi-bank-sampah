<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Penarikan extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    public function index()
    {
        // tampilan halaman list penarikan
        // jika role admin, maka tampilkan semua data penarikan
        // jika role teller atau user, maka tampilkan data penarikan yang memiliki id teller atau user tersebut

        // ambil data dari database pada tabel penarikan

        // tampilkan data ke view

        $this->penarikan_model->select('penarikan.*, teller.nama_lengkap as teller_nama_lengkap, nasabah.nama_lengkap as nasabah_nama_lengkap');
        $this->penarikan_model->join('teller', 'teller.id = penarikan.id_teller');
        $this->penarikan_model->join('nasabah', 'nasabah.id = penarikan.id_nasabah');

        $this->penarikan_model->orderBy('tanggal_penarikan', 'DESC');

        if ($this->user_role == 'nasabah') {
            $penarikan_list = $this->penarikan_model->where('id_nasabah', $this->logged_in_user['id']);
        } else if ($this->user_role == 'teller') {
            $penarikan_list = $this->penarikan_model->where('id_teller', $this->logged_in_user['id']);
        }

        $penarikan_list = $this->penarikan_model->findAll();

        $data = [
            'title' => 'List Setoran',
            'penarikan_list' => $penarikan_list,
        ];

        return view('penarikan/index', $data);
    }

    public function tambah()
    {
        if ($this->user_role != 'teller' && $this->user_role != 'nasabah') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('get')) {
            // tampilkan halaman form untuk menambah data penarikan baru
            $nasabah_list = $this->nasabah_model->findAll();
            $teller_list = $this->teller_model->findAll();
            $kategori_sampah_list = $this->kategori_model->findAll();

            $data = [
                'title' => 'Tambah Setoran',
                'nasabah_list' => $nasabah_list,
                'teller_list' => $teller_list,
                'kategori_sampah_list' => $kategori_sampah_list,
            ];

            // tampilkan halaman form untuk menambah data penarikan baru
            return view('penarikan/tambah', $data);
        } else if ($this->request->is('post')) {
            // PROSES TAMBAH DATA
            // ambil data dari form

            // validasi data

            // jika data tidak valid, maka tampilkan error menggunakan flashdata
            // dan redirect ke halaman form kembali

            // jika data valid, maka simpan data ke database

            // tampilkan pesan sukses menggunakan flashdata

            // redirect ke halaman list

            // Pengambilan data dari form
            $id_nasabah = $this->request->getPost('id_nasabah');
            $id_teller = $this->request->getPost('id_teller');
            $nominal = $this->request->getPost('nominal');

            // Telah terjadi manipulasi form
            if ($this->user_role == 'teller' && $id_teller != $this->logged_in_user['id']) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $this->penarikan_model->insert([
                'id_nasabah' => $id_nasabah,
                'id_teller' => $id_teller,
                'nominal' => $nominal,
            ]);

            $errors = $this->penarikan_model->errors();

            if ($errors) {
                var_dump($errors);
            } else {
                return redirect('penarikan');
            }
        } else {
            // jika bukan get atau post, maka tampilkan error 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
