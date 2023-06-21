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
            $nasabah_list = $this->nasabah_model->where('is_active', 1)->findAll();
            $teller_list = $this->teller_model->where('is_active', 1)->findAll();
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

            // Pengambilan data dari form
            $id_nasabah = $this->request->getPost('id_nasabah');
            $id_teller = $this->request->getPost('id_teller');
            $nominal = $this->request->getPost('nominal');

            // validasi data
            $this->validateData(
                [
                    'id_nasabah' => $id_nasabah,
                    'id_teller' => $id_teller,
                    'nominal' => $nominal,
                ],
                $this->setoran_model->getValidationRules(
                    [
                        'only' => ['id_nasabah', 'id_teller', 'nominal']
                    ]
                ),
                $this->setoran_model->getValidationMessages()
            );

            // jika data tidak valid, maka tampilkan error menggunakan flashdata
            // dan redirect ke halaman form kembali
            if ($errors = $this->validator->getErrors()) {
                var_dump($errors);
                return;
            }

            // Telah terjadi manipulasi form
            if ($this->user_role == 'teller' && $id_teller != $this->logged_in_user['id']) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $nasabah = $this->nasabah_model->find($id_nasabah);

            // Jika nasabah tidak ditemukan, maka tampilkan error 404
            if (!$nasabah || $nasabah['is_active'] == 0) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            if ($nasabah['saldo'] < $nominal || $nasabah['saldo'] - $nominal < 0) {
                // simpan pesan error ke flashdata
                var_dump("Saldo tidak cukup");

                return;
            }


            // jika data valid, maka simpan data ke database
            $this->db->transBegin();

            $this->penarikan_model->insert([
                'id_nasabah' => $id_nasabah,
                'id_teller' => $id_teller,
                'nominal' => $nominal,
            ]);

            $this->nasabah_model->update($id_nasabah, [
                'saldo' => $nasabah['saldo'] - $nominal,
            ]);

            $penarikan_errors = $this->penarikan_model->errors();
            $nasabah_errors = $this->nasabah_model->errors();


            if ($penarikan_errors || $nasabah_errors || $this->db->transStatus() === FALSE) {
                $this->db->transRollback();

                var_dump($penarikan_errors);
                var_dump($nasabah_errors);

                return;
            } else {
                // tampilkan pesan sukses menggunakan flashdata

                // redirect ke halaman list penarikan
                $this->db->transCommit();

                // simpan pesan sukses ke flashdata
                var_dump("Penarikan berhasil");

                return redirect('penarikan');
            }
        } else {
            // jika bukan get atau post, maka tampilkan error 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
