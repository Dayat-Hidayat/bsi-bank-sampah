<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $user = $this->admin_model->login('admin', 'admin');

        // $this->admin_model->insert([
        //     'username' => 'asdasd',
        //     'password' => 'asd',
        //     'name_lengkap' => 'asd'
        // ]);

        var_dump($this->admin_model->errors());

        return view('welcome_message');
    }
}
