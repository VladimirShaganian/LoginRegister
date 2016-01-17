<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('login');
        $this->view('templates/footer');
    }

    public function login_check()
    {
        $model = $this->model('main_model');
        echo $model->check_data();
    }
}