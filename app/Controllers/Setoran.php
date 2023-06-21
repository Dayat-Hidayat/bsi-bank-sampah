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

        $this->setoran_model->select('setoran.*, teller.nama_lengkap as teller_nama_lengkap, nasabah.nama_lengkap as nasabah_nama_lengkap');
        $this->setoran_model->join('teller', 'teller.id = setoran.id_teller');
        $this->setoran_model->join('nasabah', 'nasabah.id = setoran.id_nasabah');

        $this->setoran_model->orderBy('tanggal_setoran', 'DESC');

        if ($this->user_role == 'nasabah') {
            $setoran_list = $this->setoran_model->where('id_nasabah', $this->logged_in_user['id']);
        } else if ($this->user_role == 'teller') {
            $setoran_list = $this->setoran_model->where('id_teller', $this->logged_in_user['id']);
        }

        $setoran_list = $this->setoran_model->findAll();

        $data = [
            'title' => 'List Setoran',
            'setoran_list' => $setoran_list,
        ];

        return view('setoran/index', $data);
    }

    public function tambah()
    {
        if ($this->user_role != 'teller' && $this->user_role != 'nasabah') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('get')) {
            $nasabah_list = $this->nasabah_model->findAll();
            $teller_list = $this->teller_model->findAll();
            $kategori_sampah_list = $this->kategori_model->findAll();

            $data = [
                'title' => 'Tambah Setoran',
                'nasabah_list' => $nasabah_list,
                'teller_list' => $teller_list,
                'kategori_sampah_list' => $kategori_sampah_list,
            ];

            // tampilkan halaman form untuk menambah data setoran baru
            return view('setoran/tambah', $data);
        } else if ($this->request->is('post')) {
            // Pengambilan data dari form
            $id_nasabah = $this->request->getPost('id_nasabah');
            $id_teller = $this->request->getPost('id_teller');
            $id_kategori_sampah = $this->request->getPost('id_kategori_sampah');
            $berat = $this->request->getPost('berat');

            // Telah terjadi manipulasi form
            if ($this->user_role == 'teller' && $id_teller != $this->logged_in_user['id']) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            // Pengambilan data kategori sampah
            $kategori_sampah = $this->kategori_model->find($id_kategori_sampah);

            if (!$kategori_sampah) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            // Penghitungan nominal
            $nominal = $berat * $kategori_sampah['taksiran'];

            $this->setoran_model->insert([
                'id_nasabah' => $id_nasabah,
                'id_teller' => $id_teller,
                'kategori_sampah' => $kategori_sampah['nama'],
                'taksiran' => $kategori_sampah['taksiran'],
                'berat' => $berat,
                'nominal' => $nominal,
            ]);

            $errors = $this->setoran_model->errors();

            if ($errors) {
                var_dump($errors);
            } else {
                return redirect('setoran');
            }
        } else {
            // jika bukan get atau post, maka tampilkan error 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
