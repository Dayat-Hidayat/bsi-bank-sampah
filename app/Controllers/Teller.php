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
        // if ($this->user_role != 'teller' && $this->user_role != 'admin') {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }
    }

    public function index()
    {
        if ($this->user_role != "admin") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $teller_list = $this->teller_model->findAll();
        $this->teller_model->join('user', 'user.id = teller.id_user');

        $data = [
            'title' => 'Daftar Teller',
            'teller_list' => $teller_list
        ];

        return view('teller/index', $data);
    }

    public function tambah()
    {
        if ($this->user_role != "admin") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('get')) {
            $data = [
                'title' => 'Ubah Teller',
            ];
            // tampilkan halaman form untuk menambah data teller baru
            return view('teller/tambah', $data);
        } else if ($this->request->is('post')) {
            // PROSES TAMBAH DATA
            // ambil data dari form
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $konfirmasi_password = $this->request->getPost('konfirmasi_password');
            $nama_lengkap = $this->request->getPost('nama_lengkap');
            $email = $this->request->getPost('email');
            $nomor_telepon = $this->request->getPost('nomor_telepon');

            $this->validateData(
                [
                    'username' => $username,
                    'password' => $password,
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'nomor_telepon' => $nomor_telepon,
                ],
                $this->teller_model->getValidationRules([
                    'only' => [
                        'username',
                        'password',
                        'nama_lengkap',
                        'email',
                        'nomor_telepon',
                    ]
                ]),
                $this->teller_model->getValidationMessages()
            );

            // jika data tidak valid, maka tampilkan error menggunakan flashdata
            // dan redirect ke halaman form kembali
            if ($errors = $this->validator->getErrors()) {
                var_dump($errors);
                return;
                // session()->setFlashdata('error', $errors);
                // return redirect()->back();
            }

            // validasi data
            if ($password != $konfirmasi_password) {
                var_dump('Password dan konfirmasi password tidak sama');
                return;
                // session()->setFlashdata('errors', 'Password dan konfirmasi password tidak sama');
                // return redirect()->back();
            }

            // jika data valid, maka simpan data ke database
            $this->teller_model->insert([
                'username' => $username,
                'password' => $password,
                'nama_lengkap' => $nama_lengkap,
                'email' => $email,
                'nomor_telepon' => $nomor_telepon,
                'is_active' => 1,
            ]);

            if ($errors = $this->teller_model->errors()) {
                var_dump($errors);
                return;
                // session()->setFlashdata('error', $this->teller_model->errors());
                // return redirect()->back();
            } else {
                session()->setFlashdata('success', 'Berhasil menambahkan teller baru');
                return redirect()->to(base_url('teller'));
            }
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
        if (
            !($this->user_role == 'admin'
                || ($this->user_role == 'teller' && $this->logged_in_user['id'] == $id)
            )
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('get')) {
            // ambil data dari database pada table teller berdasarkan id
            $teller = $this->teller_model->find($id);

            // jika data tidak ditemukan, maka tampilkan error 404
            if (!$teller) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $data = [
                'title' => 'Ubah Teller',
                'teller' => $teller,
            ];

            return view('teller/ubah', $data);
        } else if ($this->request->is('post')) {
            // PROSES UBAH DATA
            // ambil data dari form
            $username = $this->request->getPost('username');
            $nama_lengkap = $this->request->getPost('nama_lengkap');
            $email = $this->request->getPost('email');
            $nomor_telepon = $this->request->getPost('nomor_telepon');

            // validasi data
            $this->validateData(
                [
                    'username' => $username,
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'nomor_telepon' => $nomor_telepon,
                ],
                $this->teller_model->getValidationRules([
                    'only' => [
                        'username',
                        'nama_lengkap',
                        'email',
                        'nomor_telepon',
                    ]
                ]),
                $this->teller_model->getValidationMessages()
            );

            if ($errors = $this->validator->getErrors()) {
                var_dump($errors);
                return;
                // session()->setFlashdata('error', $errors);
                // return redirect()->back();
            }

            $this->teller_model->update($id, [
                'username' => $username,
                'nama_lengkap' => $nama_lengkap,
                'email' => $email,
                'nomor_telepon' => $nomor_telepon,
            ]);

            if ($errors = $this->teller_model->errors()) {
                var_dump($errors);
                return;
                // session()->setFlashdata('error', $this->teller_model->errors());
                // return redirect()->back();
            } else {
                session()->setFlashdata('success', 'Berhasil mengubah data teller');
                return redirect()->to(base_url('teller'));
            }
        } else {
            // jika bukan get atau post, maka tampilkan error 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function ganti_password(int $id)
    {
        $password_lama = $this->request->getPost('password_lama');
        $password_baru = $this->request->getPost('password_baru');
        $konfirmasi_password_baru = $this->request->getPost('konfirmasi_password_baru');

        $this->validateData(
            [
                'password' => $password_baru,
            ],
            $this->teller_model->getValidationRules([
                'only' => [
                    'password',
                ]
            ]),
            $this->teller_model->getValidationMessages()
        );

        if ($errors = $this->validator->getErrors()) {
            var_dump($errors);
            return;
            // session()->setFlashdata('error', $errors);
            // return redirect()->back();
        }

        $teller = $this->teller_model->find($id);

        if (!$teller) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($password_baru != $konfirmasi_password_baru) {
            var_dump('Password baru dan konfirmasi password baru tidak sama');
            return;
            // session()->setFlashdata('error', 'Password baru dan konfirmasi password baru tidak sama');
            // return redirect()->back();
        }

        if (!password_verify((string) $password_lama, $teller['password'])) {
            var_dump('Password lama tidak sesuai');
            return;
            // session()->setFlashdata('error', 'Password lama tidak sesuai');
            // return redirect()->back();
        }

        $this->teller_model->update($id, [
            'password' => $password_baru,
        ]);

        $errors = $this->teller_model->errors();
        if ($errors) {
            var_dump($errors);
            return;
            // session()->setFlashdata('error', $this->teller_model->errors());
            // return redirect()->back();
        } else {
            session()->setFlashdata('success', 'Berhasil mengubah password');
            return redirect()->to(base_url('teller'));
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
