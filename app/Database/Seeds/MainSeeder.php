<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // inisialisasi faker
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(1234);

        $date_format = 'Y-m-d H:i:s';
        // Mengisi tabel user dengan data random

        $admin = [
            [
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Administrator',
                'terakhir_login' => $faker->dateTimeThisYear('now', 'Asia/Jakarta')->format($date_format),
            ]
        ];


        $tanggal = $faker->dateTimeThisYear('now', 'Asia/Jakarta')->format($date_format);
        $teller = [
            [
                'username' => 'teller',
                'password' => password_hash('teller', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Teller',
                'nomor_telepon' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'tanggal_daftar' => $tanggal,
                'terakhir_login' => $tanggal,
            ]
        ];

        // Ubah Faker Jadi 4 dari 10, Biar gak kebanyakan data. Pusing liatnya!!
        for ($i = 0; $i < 4; $i++) {
            $tanggal = $faker->dateTimeThisYear('now', 'Asia/Jakarta')->format($date_format);
            $username = $faker->userName;
            $nama_lengkap = $faker->name();
            $nomor_telepon = $faker->phoneNumber();
            $email = $faker->email();
            $tanggal_daftar = $tanggal;
            $terakhir_login = $tanggal;

            $teller[] = [
                'username' => $username,
                'password' => password_hash($username, PASSWORD_DEFAULT),
                'nama_lengkap' => $nama_lengkap,
                'nomor_telepon' => $nomor_telepon,
                'email' => $email,
                'tanggal_daftar' => $tanggal_daftar,
                'terakhir_login' => $terakhir_login,
            ];
        }

        uasort($teller, function ($a, $b) {
            return $a['tanggal_daftar'] <=> $b['tanggal_daftar'];
        });

        // Reset array index
        $teller = array_values($teller);

        $nasabah = [
            [
                'username' => 'nasabah',
                'password' => password_hash('nasabah', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Nasabah',
                'alamat' => $faker->address(),
                'nomor_telepon' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'saldo' => 0,
                'tanggal_daftar' => $tanggal,
                'terakhir_login' => $tanggal,
                // Nasabah Akun Kenapa pakai faker ? Kalo dapet is_active 0 nanti kan gak bisa login
                'is_active' => $faker->boolean(85),
            ]
        ];

        // Ubah Faker Jadi 4 dari 25, Biar gak kebanyakan data. Pusing liatnya!!
        for ($i = 0; $i < 4; $i++) {
            $tanggal = $faker->dateTimeThisYear('now', 'Asia/Jakarta')->format($date_format);

            $username = $faker->userName;
            $nama_lengkap = $faker->name();
            $alamat = $faker->address();
            $nomor_telepon = $faker->phoneNumber();
            $email = $faker->email();
            $saldo = 0;
            $tanggal_daftar = $tanggal;
            $terakhir_login = $tanggal;
            $is_active = $faker->boolean(85);

            $nasabah[] = [
                'username' => $username,
                'password' => password_hash($username, PASSWORD_DEFAULT),
                'nama_lengkap' => $nama_lengkap,
                'alamat' => $alamat,
                'nomor_telepon' => $nomor_telepon,
                'email' => $email,
                'saldo' => $saldo,
                'tanggal_daftar' => $tanggal_daftar,
                'terakhir_login' => $terakhir_login,
                'is_active' => $is_active,
            ];
        }

        uasort($nasabah, function ($a, $b) {
            return $a['tanggal_daftar'] <=> $b['tanggal_daftar'];
        });

        // Reset array index
        $teller = array_values($teller);

        $kategori_yang_ada = [
            "Kertas",
            "Plastik",
            "Kaca",
            "Kaleng",
            "Kain",
            "Karet",
            "Kayu",
            "Limbah B3",
        ];

        // Mengisi tabel kategori
        $kategori = [];

        for ($i = 0; $i < count($kategori_yang_ada); $i++) {
            $kategori[] = [
                'nama' => $kategori_yang_ada[$i],
                'taksiran' => $faker->numberBetween(1000, 10000),
                // Kenapa Stok Pake Float ??
                // Ubah Jadi number dari randomFloat(2, 0, 10)
                'stok' => $faker->numberBetween(10, 50),
                'terakhir_diperbarui' => $faker->dateTimeThisYear('now', 'Asia/Jakarta')->format($date_format),
            ];
        }

        $setoran = [];
        $penarikan = [];

        for ($i = 0; $i < count($nasabah); $i++) {

            $jumlah_setoran = $faker->numberBetween(0, 5);
            $jumlah_penarikan = $faker->numberBetween(0, $jumlah_setoran);

            for ($j = 0; $j < $jumlah_setoran; $j++) {
                $index_teller = $faker->numberBetween(0, count($teller) - 1);

                $index_kategori_sampah = $faker->numberBetween(1, count($kategori) - 1);
                $kategori_sampah = $kategori[$index_kategori_sampah]['nama'];
                $taksiran = $kategori[$index_kategori_sampah]['taksiran'];
                // Ubah jadi number dari randomFloat(2, 0, 10)
                $berat = $faker->numberBetween(5, 20);
                $nominal = floor($berat * $taksiran);
                $tanggal_setor = $faker->dateTimeThisYear('now', 'Asia/Jakarta')->format($date_format);

                $nasabah[$i]['saldo'] += $nominal;

                $setoran[] = [
                    'id_nasabah' => $j + 1,
                    'id_teller' => $index_teller + 1,
                    'kategori_sampah' => $kategori_sampah,
                    'taksiran' => $taksiran,
                    'berat' => $berat,
                    'nominal' => $nominal,
                    'tanggal_setor' => $tanggal_setor,
                ];
            }

            for ($j = 0; $j < $jumlah_penarikan; $j++) {

                $index_teller = $faker->numberBetween(0, count($teller) - 1);

                $nominal = $faker->numberBetween(0, $nasabah[$i]['saldo']);
                $tanggal_penarikan = $faker->dateTimeThisYear('now', 'Asia/Jakarta')->format($date_format);

                $nasabah[$i]['saldo'] -= $nominal;

                $penarikan[] = [
                    'id_nasabah' => $j + 1,
                    'id_teller' => $index_teller + 1,
                    'nominal' => $nominal,
                    'tanggal_penarikan' => $tanggal_penarikan,
                ];
            }
        }

        uasort($setoran, function ($a, $b) {
            return $a['tanggal_setor'] <=> $b['tanggal_setor'];
        });
        uasort($penarikan, function ($a, $b) {
            return $a['tanggal_penarikan'] <=> $b['tanggal_penarikan'];
        });

        // Reset array index
        $setoran = array_values($setoran);
        $penarikan = array_values($penarikan);

        $this->db->table('admin')->insertBatch($admin);
        $this->db->table('teller')->insertBatch($teller);
        $this->db->table('nasabah')->insertBatch($nasabah);
        $this->db->table('kategori')->insertBatch($kategori);
        $this->db->table('setoran')->insertBatch($setoran);
        $this->db->table('penarikan')->insertBatch($penarikan);
    }
}
