<?php

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отображение логин формы
     */
    public function index()
    {
        $data = $this->i18n();
        $this->view('templates/header');
        $this->view('login', $data);
        $this->view('templates/footer');
    }

    /**
     *  Проверка логина
     */
    public function login_check()
    {
        $model = $this->model('main_model');
        echo $model->check_data();
    }


}