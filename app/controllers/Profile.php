<?php

class Profile extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отоборажение формы профиля
     */
    public function index()
    {
        $model = $this->model('main_model');
        $data = $model->get_data();
        $lang = $this->i18n();
        $data = array_merge($data, $lang);
        $this->view('templates/header');
        $this->view('profile', $data);
        $this->view('templates/footer');



    }

    /**
     *  Выход из профиля
     */
    public function logout()
    {

        unset($_SESSION['user_id']);
        header('Location: /login');
    }

}