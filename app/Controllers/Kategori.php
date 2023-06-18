<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kategori extends BaseController
{
    public function __construct()
    {
        // cek role di session
        // jika role tidak sama dengan admin, maka
        // tampilkan halaman error 403 (404)
        if ($this->user_role != 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function index()
    {
        // tampilan halaman list kategori

        // ambil data dari database pada tabel kategori

        // tampilkan data ke view
    }

    public function ubah(int $id)
    {
        if ($this->request->is('get')) {
            // tampilkan halaman form untuk mengubah data kategori

            // ambil data dari database pada table kategori berdasarkan id

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
        // PROSES HAPUS DATA

        // ambil data dari database pada table kategori berdasarkan id

        // jika data tidak ditemukan, maka tampilkan error 404

        // jika data ditemukan, maka hapus data dari database

        // tampilkan pesan sukses menggunakan flashdata

        // redirect ke halaman list
    }
}
