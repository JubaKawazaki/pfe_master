<?php
class AdminsController
{
    public function addAdmin()
    {
        if (isset($_POST['ajouter_adm'])) {
            $data = array(
                'id' => $_POST['id'],
                'mat' => $_POST['mat'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Vous devriez toujours hacher les mots de passe
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'ssn' => $_POST['ssn'],
                'sexe' => $_POST['sexe'],
                'sf' => $_POST['sf'],
                'type' => 'admin',
                'date_nais' => $_POST['date_naiss'],
                'nbr_enft' => $_POST['nbr_enft'],
                'invalid' => $_POST['invalid'],
                'status' => $_POST['status'],
                'poste' => $_POST['poste'],
                'position' => $_POST['position'],
                'grade' => $_POST['grade'],
                'qualif' => $_POST['qualif'],
                'categorie' => $_POST['categorie'],
                'section' => $_POST['section'],
                'date_entre' => $_POST['date_entre'],
                'motif_entre' => $_POST['motif_entre'],
                'id_service' => $_POST['service'],

                'id_adm' => $_SESSION['id'] // Utilisez l'ID de l'administrateur actuel
            );

            $resultat = Admins::addAdmin($data);

            if ($resultat == 'ok') {
                Session::set('success', 'Administrateur ajouté avec succès');
                Redirect::to('homeAdmins');
            } else {
                Session::set('error', 'Erreur lors de l\'ajout de l\'administrateur');
                Redirect::to('addAdmin'); // Assurez-vous de rediriger vers la bonne page en cas d'erreur
            }
        }
    }
    public function adduser()
    {
        if (isset($_POST['ajouter_adm'])) {
            $data = array(
                'id' => $_POST['id'],
                'mat' => $_POST['mat'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Vous devriez toujours hacher les mots de passe
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'ssn' => $_POST['ssn'],
                'sexe' => $_POST['sexe'],
                'sf' => $_POST['sf'],
                'type' => 'user',
                'date_nais' => $_POST['date_naiss'],
                'nbr_enft' => $_POST['nbr_enft'],
                'invalid' => $_POST['invalid'],
                'status' => $_POST['status'],
                'poste' => $_POST['poste'],
                'position' => $_POST['position'],
                'grade' => $_POST['grade'],
                'qualif' => $_POST['qualif'],
                'categorie' => $_POST['categorie'],
                'section' => $_POST['section'],
                'date_entre' => $_POST['date_entre'],
                'motif_entre' => $_POST['motif_entre'],
                'id_service' => $_POST['service'],

                'id_adm' => $_SESSION['id'] // Utilisez l'ID de l'administrateur actuel
            );

            $resultat = Admins::addAdmin($data);

            if ($resultat == 'ok') {
                Session::set('success', 'Administrateur ajouté avec succès');
                Redirect::to('Listuser');
            } else {
                Session::set('error', 'Erreur lors de l\'ajout de l\'administrateur');
                Redirect::to('addAdmin'); // Assurez-vous de rediriger vers la bonne page en cas d'erreur
            }
        }
    }
    public function getAllAdmins()
    {

        $employes = Admins::getAllAdminInfo();
        return $employes;
    }
    public function getAllusers()
    {

        $employes = Admins::getAlluserInfo();
        return $employes;
    }
    public function findEmployeADM()
    {
        $data = array();

        if (isset($_POST['rech'])) {

            $rech = $_POST['rech'];
            $data['rech'] = $rech;
        }
        $employes = Admins::recharchEmp($data);
        return $employes;
    }
    public function findAdminADM()
    {
        $data = array();

        if (isset($_POST['rech'])) {

            $rech = $_POST['rech'];
            $data['rech'] = $rech;
        }
        $employes = Admins::recharchAdm($data);
        return $employes;
    }
    public function updateADMS()
    {
        if (isset($_POST['upd'])) {
            $data = array(
                'id' => $_POST['id'],
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'ssn' => $_POST['ssn'],
                'sexe' => $_POST['sexe'],
                'sf' => $_POST['sf'],
                'date_nais' => $_POST['date_naiss'],
                'nbr_enft' => $_POST['nbr_enft'],
                'invalid' => $_POST['invalid'],
                'status' => $_POST['status'],
                'position' => $_POST['position'],
                'poste' => $_POST['poste'],
                'grade' => $_POST['grade'],
                'qualif' => $_POST['qualif'],
                'categorie' => $_POST['categorie'],
                'section' => $_POST['section'],
                'date_entre' => $_POST['date_entre'],
                'motif_entre' => $_POST['motif_entre'],

                // Utilisez le champ 'service' pour id_service
            );


            $resultat = Admins::editADS($data);

            if ($resultat == 'ok') {
                Session::set('success', 'Employé modifié avec succès');
                Redirect::to('homeAdmins');
            } else {
                Session::set('error', 'Erreur lors de la modification de l\'employé');
                Redirect::to('update');
            }
        }
    }
    public function updateADMSEMP()
    {
        if (isset($_POST['upd'])) {
            $data = array(
                'id' => $_POST['id'],
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'ssn' => $_POST['ssn'],
                'sexe' => $_POST['sexe'],
                'sf' => $_POST['sf'],
                'date_nais' => $_POST['date_naiss'],
                'nbr_enft' => $_POST['nbr_enft'],
                'invalid' => $_POST['invalid'],
                'status' => $_POST['status'],
                'position' => $_POST['position'],
                'poste' => $_POST['poste'],
                'grade' => $_POST['grade'],
                'qualif' => $_POST['qualif'],
                'categorie' => $_POST['categorie'],
                'section' => $_POST['section'],
                'date_entre' => $_POST['date_entre'],
                'motif_entre' => $_POST['motif_entre'],
                // Utilisez le champ 'service' pour id_service
            );


            $resultat = Admins::editADS($data);

            if ($resultat == 'ok') {
                Session::set('success', 'Employé modifié avec succès');
                Redirect::to('Listuser');
            } else {
                Session::set('error', 'Erreur lors de la modification de l\'employé');
                Redirect::to('update');
            }
        }
    }
    public function deleteemploye()
    {
        $data = array();

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $data['id'] = $id;
            $mat = $_POST['mat'];
            $data['mat'] = $mat;
        }
        $res = Employe::delete($data);
        if ($res = 'ok') {
            Session::set('success', 'Emplpoye Suprimer');
            Redirect::to('Listuser');
        } else {
            echo $res;
        }
    }
    public function deleteadmin()
    {
        $data = array();

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $data['id'] = $id;
            $mat = $_POST['mat'];
            $data['mat'] = $mat;
        }
        $res = Employe::delete($data);
        if ($res = 'ok') {
            Session::set('success', 'Emplpoye Suprimer');
            Redirect::to('homeAdmins');
        } else {
            echo $res;
        }
    }
}
