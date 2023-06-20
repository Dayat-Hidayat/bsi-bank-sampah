<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Auth extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    public function login()
    {
        if ($this->request->is('get')) {
            // tampilkan halaman login
            return view('auth/login');
        } else if ($this->request->is('post')) {
            // PROSES LOGIN

            // ambil data dari form (username, password)
            $username = $this->request->getPost('username');
            $password = (string) $this->request->getPost('password');
            $role = $this->request->getPost('role');

            // validasi data dengan cara cek masing masing tabel (admin, teller, nasabah)
            // untuk menentukan apakah data tersebut ada di tabel tersebut
            // dan untuk menentukan role dari user tersebut
            // jika data ada di tabel admin, maka role = admin, dst
            $user = '';

            if ($role == 'admin') {
                $user = $this->admin_model->where('username', $username)->first();
            } else if ($role == 'teller') {
                $user = $this->teller_model->where('username', $username)->first();
            } else {
                $user = $this->nasabah_model->where('username', $username)->first();
            }

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->session->set('user', $user);
                    $this->session->set('role', $role);

                    return redirect($role);
                } else {
                    $this->session->setFlashdata('error', 'Password salah');
                    return redirect('auth/login');
                }
            } else {
                $this->session->setFlashdata('error', 'Username tidak ditemukan');
                return redirect('auth/login');
            }
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
        return redirect('auth/login');
    }
}
