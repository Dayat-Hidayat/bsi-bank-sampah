<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->is('get')) {
            // tampilkan halaman login
        } else if ($this->request->is('post')) {
            // PROSES LOGIN

            // ambil data dari form (username, password)

            // validasi data dengan cara cek masing masing tabel (admin, teller, nasabah)
            // untuk menentukan apakah data tersebut ada di tabel tersebut
            // dan untuk menentukan role dari user tersebut
            // jika data ada di tabel admin, maka role = admin, dst

            // jika data tidak ada di tabel manapun, maka tampilkan pesan error
            // menggunakan flashdata
            // dan redirect ke halaman login kembali

            // jika data ada di tabel manapun, tapi password tidak cocok, maka
            // tampilkan pesan error menggunakan flashdata
            // dan redirect ke halaman login kembali

            // jika data ada di tabel manapun, dan password cocok, maka
            // simpan data user tersebut ke session
            // simpan juga role dari user tersebut ke session
            // agar memudahkan pengecekan di halaman lain

            // redirect ke halaman sesuai role
        } else {
            // jika bukan get atau post, maka tampilkan error 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function logout()
    {
        // hapus data user dari session
        $this->session->destroy();
        $this->session->setFlashdata('success', 'Anda berhasil logout');

        // redirect ke halaman login
        return redirect()->to('/auth/login');
    }
}
