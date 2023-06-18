<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseUserModel extends Model
{
    public function cb_hash_password(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    public function cb_insert_tanggal_daftar(array $data)
    {
        $data['data']['tanggal_daftar'] = date('Y-m-d H:i:s');

        return $data;
    }

    public function login($username, $password)
    {
        $user = $this->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->update($user['id'], ['terakhir_login' => date('Y-m-d H:i:s')]);

                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_by_username($username)
    {
        return $this->where('username', $username)->first();
    }
}
