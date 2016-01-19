<?php

class Lang extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = $this->i18n();
        echo json_encode($data);
    }
}