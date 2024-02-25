<?php
class UserController
{
    public function cnx()
    {
        if (isset($_POST['cnx'])) {
            $id = $_POST['id'];
            $mat = $_POST['Matricule'];
            $password = $_POST['password']; // Utilisez MD5 pour le mot de passe

            $data['id'] = $id;
            $data['mat'] = $mat;

            $res = User::login($data);

            if (
                $res->id === $_POST['id'] &&
                $res->mat === $_POST['Matricule'] &&
                $res->password === $password

            ) {
                // Authentification réussie
                $_SESSION['logged'] = true;
                $_SESSION['id'] = $res->id;
                $_SESSION['username'] = $res->nom;
                $_SESSION['mat'] = $res->mat;
                $_SESSION['type'] = $res->type;
                $_SESSION['id_adm'] = $res->id_adm;
                $_SESSION['id_service'] = $res->id_service;

                Redirect::to('Dashboard');
            } else {
                // Mot de passe incorrect
                Session::set('error', 'Mot de passe ou identifiant incorrect');
                Redirect::to('Login');
            }
        }
    }

}
