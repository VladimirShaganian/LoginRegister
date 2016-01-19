<?php

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = $this->i18n();
        $this->view('templates/header');
        $this->view('login', $data);
        $this->view('templates/footer');
    }

    public function login_check()
    {
        $model = $this->model('main_model');
        echo $model->check_data();
    }


}