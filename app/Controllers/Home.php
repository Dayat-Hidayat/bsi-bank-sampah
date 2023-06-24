<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if ($this->user_role == 'admin') {
            return $this->dashboard_admin();
        } else if ($this->user_role == 'teller') {
            return $this->dashboard_teller();
        } else if ($this->user_role == 'nasabah') {
            return $this->dashboard_nasabah();
        } else {
            return $this->dashboard_umum();
        }
    }

    public function dashboard_umum()
    {
        $this->kategori_model->orderBy('taksiran', 'DESC');
        $kategori_list = $this->kategori_model->findAll();

        $data = [
            'title' => 'Dashboard Umum',
            'kategori_list' => $kategori_list,
        ];

        return view('dashboard/umum', $data);
    }

    public function dashboard_nasabah()
    {
        $this->setoran_model->select('setoran.*, teller.nama_lengkap as teller_nama_lengkap');
        $this->setoran_model->join('teller', 'teller.id = setoran.id_teller');
        $this->setoran_model->orderBy('tanggal_setor', 'ASC');
        $this->setoran_model->where('id_nasabah', $this->logged_in_user['id']);
        $setoran_list = $this->setoran_model->findAll(5);

        $this->penarikan_model->select('penarikan.*, teller.nama_lengkap as teller_nama_lengkap');
        $this->penarikan_model->join('teller', 'teller.id = penarikan.id_teller');
        $this->penarikan_model->orderBy('tanggal_penarikan', 'ASC');
        $this->penarikan_model->where('id_nasabah', $this->logged_in_user['id']);
        $penarikan_list = $this->penarikan_model->where('id_nasabah', $this->logged_in_user['id'])->findAll(5);

        $this->kategori_model->orderBy('taksiran', 'DESC');
        $kategori_list = $this->kategori_model->findAll(5);

        $data = [
            'title' => 'Dashboard Nasabah',
            'setoran_list' => $setoran_list,
            'penarikan_list' => $penarikan_list,
            'kategori_list' => $kategori_list,
        ];

        return view('dashboard/nasabah', $data);
    }

    public function dashboard_teller()
    {
        $nasabah_list = $this->nasabah_model->findAll(5);

        $this->setoran_model->select('setoran.*, nasabah.nama_lengkap as nasabah_nama_lengkap');
        $this->setoran_model->join('nasabah', 'nasabah.id = setoran.id_nasabah');
        $this->setoran_model->orderBy('tanggal_setor', 'ASC');
        $this->setoran_model->where('id_teller', $this->logged_in_user['id']);
        $setoran_list = $this->setoran_model->findAll(5);

        $this->penarikan_model->select('penarikan.*, nasabah.nama_lengkap as nasabah_nama_lengkap');
        $this->penarikan_model->join('nasabah', 'nasabah.id = penarikan.id_nasabah');
        $this->penarikan_model->orderBy('tanggal_penarikan', 'ASC');
        $this->penarikan_model->where('id_teller', $this->logged_in_user['id']);
        $this->penarikan_model->where('id_teller', $this->logged_in_user['id']);
        $penarikan_list = $this->penarikan_model->findAll(5);

        $data = [
            'title' => 'Dashboard Teller',
            'nasabah_list' => $nasabah_list,
            'setoran_list' => $setoran_list,
            'penarikan_list' => $penarikan_list,
        ];

        return view('dashboard/teller', $data);
    }

    public function dashboard_admin()
    {
        $nasabah_list = $this->nasabah_model->findAll(5);
        $teller_list = $this->teller_model->findAll(5);

        $this->setoran_model->select('setoran.*, teller.nama_lengkap as teller_nama_lengkap, nasabah.nama_lengkap as nasabah_nama_lengkap');
        $this->setoran_model->join('teller', 'teller.id = setoran.id_teller');
        $this->setoran_model->join('nasabah', 'nasabah.id = setoran.id_nasabah');
        $this->setoran_model->orderBy('tanggal_setor', 'ASC');
        $setoran_list = $this->setoran_model->findAll(5);

        $this->penarikan_model->select('penarikan.*, teller.nama_lengkap as teller_nama_lengkap, nasabah.nama_lengkap as nasabah_nama_lengkap');
        $this->penarikan_model->join('teller', 'teller.id = penarikan.id_teller');
        $this->penarikan_model->join('nasabah', 'nasabah.id = penarikan.id_nasabah');
        $this->penarikan_model->orderBy('tanggal_penarikan', 'ASC');
        $penarikan_list = $this->penarikan_model->findAll(5);

        $kategori_list = $this->kategori_model->findAll(5);

        $data = [
            'title' => 'Dashboard Admin',
            'nasabah_list' => $nasabah_list,
            'teller_list' => $teller_list,
            'setoran_list' => $setoran_list,
            'penarikan_list' => $penarikan_list,
            'kategori_list' => $kategori_list,
        ];

        return view('dashboard/admin', $data);
    }
}
