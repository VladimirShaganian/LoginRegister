<?php

class Main_model extends Model
{
    public function __construct()
    {
        session_start();
    }
    public function check_data()
    {
        $db = $this->db(); // подключение базы данных

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            if (isset($_POST['password']) && !empty($_POST['password'])) {

                $email = $_POST['email'];
                $pass = sha1($_POST['password']);

                $query = $db->prepare("SELECT id FROM users WHERE email = :email AND password = :pass");
                $query->execute([
                        'email' => $email,
                        'pass' => $pass,
                    ]
                );

                if ($query->rowCount() == 0) {
                    return "false";
                } else {
                    $row = $query->fetch();

                    $_SESSION['user_id'] = $row['id'];
                }
            }
        }
    }

    public function save_data()
    {
        $db = $this->db(); // подключение базы данных

        if (!empty($_POST)) {
            if ($_POST['first_name']) {
                $first_name = $_POST['first_name'];
            }
            if ($_POST['last_name']) {
                $last_name = $_POST['last_name'];
            } else {
                $last_name = "";
            }
            if ($_POST['email']) {
                $email = $_POST['email'];
            }
            if ($_POST['password']) {
                $pass = $_POST['password'];
                $pass = sha1($pass);
            }

            // Загрузка фотографии
            if (!empty($_FILES['image']['name'])) {
                if (!$_FILES['image']['error']) {
                    $file_name =  $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/' . $file_name);
                }
            } else {
                $file_name = "";
            }

            // Проверка уникальности E-mail и запись данных пользователя в таблицу если E-mail уникален
            $query = $db->prepare('SELECT email FROM users where email=:email');
            $query->execute([
                'email' => $email,
            ]);

            if ($query->rowCount() == 0) {
                $query = $db->prepare('INSERT INTO users (first_name, last_name, email, password, image)
            VALUES (:first_name, :last_name, :email, :pass, :file_name)');
                $query->execute([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'pass' => $pass,
                    'file_name' => $file_name,
                ]);
            } else {
                echo 'Пользователь с таким эл. адресом уже существует';
            }
        }
    }

    public function get_data()
    {
        $user_id = $_SESSION['user_id'];
        $db = $this->db();

        $query = $db->prepare('SELECT first_name, last_name, email, image FROM users WHERE id=:user_id');
        $query->execute([
            'user_id' => $user_id,
        ]);

        $row = $query->fetch();

        $first_name = $this->escape($row['first_name']);
        $last_name = $this->escape($row['last_name']);
        $email = $this->escape($row['email']);
        $image = $this->escape($row['image']);

        if (empty($image)) {
            $image = "..assets/images/user_blank_200x200.jpg";
        }

        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'image' => $image,
        ];

        return $data;
    }

    public function escape($string) {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
}
