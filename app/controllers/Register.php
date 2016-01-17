<?php

class Register extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('register');
        $this->view('templates/footer');

    }

    public function add_user()
    {
        $model = $this->model('main_model');
        $model->save_data();
    }

}