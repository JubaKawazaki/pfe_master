<?php
class UserController
{
    public function cnx()
    {
        if (isset($_POST['cnx'])) {

            $mat = $_POST['Matricule'];
            $password = $_POST['password']; // Utilisez MD5 pour le mot de passe


            $data['mat'] = $mat;

            $res = User::logine($data);

            if (

                $res->mat === $_POST['Matricule'] &&
                $res->password === $password

            ) {
                // Authentification réussie
                $_SESSION['logged'] = true;

                $_SESSION['username'] = $res->nom;
                $_SESSION['nom'] = $res->nom;
                $_SESSION['prenom'] = $res->prenom;
                $_SESSION['mat'] = $res->mat;
                $_SESSION['type'] = $res->type;
                $_SESSION['id_adm'] = $res->id_adm;
                $_SESSION['id_service'] = $res->id_service;
                $_SESSION['poste'] = $res->poste;

                Redirect::to('Dashboard');
            } else {
                // Mot de passe incorrect
                Session::set('error', 'Mot de passe ou identifiant incorrect');
                Redirect::to('login');
            }
        }
    }


    public function Register()
    {
        if (isset($_POST['register'])) {
            $option = [
                'cost' => 12
            ];
            $password = password_hash(
                $_POST['password'],
                PASSWORD_BCRYPT,
                $option
            );
            $data = array(
                'fullname' => $_POST['fullname'],
                'username' => $_POST['username'],
                'password' => $password

            );
            $resulats = User::createUser($data);
            if ($resulats == 'ok') {
                Session::set('success', 'compte user crée ');
                Redirect::to('login');
            } else {
                echo $resulats;
            }
        }
    }
    public function deco()
    {
        session_destroy();
    }
}
