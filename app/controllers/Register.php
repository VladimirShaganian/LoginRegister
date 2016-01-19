<?php

class Register extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отображение формы регистрации
     */
    public function index()
    {
        $data = $this->i18n();
        $this->view('templates/header');
        $this->view('register', $data);
        $this->view('templates/footer');
    }

    /**
     * Добавление пользователя в БД
     */
    public function add_user()
    {
        $model = $this->model('main_model');
        echo $model->save_data();
    }

}