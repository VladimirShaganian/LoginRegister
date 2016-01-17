<?php

class Profile extends Controller
{

    public function index()
    {
        $model = $this->model('main_model');
        $data = $model->get_data();

        $this->view('templates/header');
        $this->view('profile', $data);
        $this->view('templates/footer');



    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        header('Location: /login');
    }

}