<?php
class EmployesController
{
    public function getServiceControlle()
    {
        $service = Employe::getServiceModele();
        return $service;
    }
    public function getStructureControlle()
    {
        $structure = Employe::getStructureModele();
        return $structure;
    }
    public function getAllEmployes()
    {
        $id_service =  $_SESSION['id_service'];
        $id =  $_SESSION['id'];
        $employes = Employe::getAll($id, $id_service);
        return $employes;
    }





    public function getOneEmploye()
    {
        $data = array();

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $data['id'] = $id; // Ajoutez 'id' au tableau $data

        }

        $employ = Employe::getEmployes($data);
        return $employ;
    }
    public function adduser()
    {
        if (isset($_POST['ajouter_Emp'])) {
            $data = array(
                'id' => $_POST['id'],
                'mat' => $_POST['mat'],
                'password' => $_POST['password'],
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
                'position' => $_POST['position'],
                'grade' => $_POST['grade'],
                'poste' => $_POST['poste'],
                'qualif' => $_POST['qualif'],
                'categorie' => $_POST['categorie'],
                'section' => $_POST['section'],
                'date_entre' => $_POST['date_entre'],
                'motif_entre' => $_POST['motif_entre'],
                'id_service' => $_SESSION['id_service'],

                'id_adm' => $_SESSION['id'] // Utilisez l'ID de l'administrateur actuel
            );

            $resultat = Employe::addEmp($data);


            if ($resultat == 'ok') {
                Session::set('success', 'Administrateur ajouté avec succès');
                Redirect::to('home');
            } else {
                Session::set('error', 'Erreur lors de l\'ajout de l\'administrateur');
                Redirect::to('addEmp'); // Assurez-vous de rediriger vers la bonne page en cas d'erreur
            }
        }
    }

    public function update()
    {
        if (isset($_POST['upduser'])) {
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
                'id_service' => $_POST['service'],
                'id_structure' => $_POST['structure']
                // Utilisez le champ 'service' pour id_service
            );


            $resultat = Employe::edit($data);

            if ($resultat == 'ok') {
                Session::set('success', 'Employé modifié avec succès');
                Redirect::to('home');
            } else {
                Session::set('error', 'Erreur lors de la modification de l\'employé');
                Redirect::to('updateuse');
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
            return true;
            // Session::set('success', 'Emplpoye Suprimer');
            //Redirect::to('home');
        } else {
            return false;
            // echo $res;
        }
    }

    public function findEmploye()
    {

        $data = array();

        if (isset($_POST['rech'])) {

            $rech = $_POST['rech'];
            $id_service = $_SESSION['id_service'];
            $data['rech'] = $rech;
            $data['id_service'] = $id_service;
        }
        $employes = Employe::recharchEmp($data);
        return $employes;
    }

    public  function getadm()
    {
        if (isset($_POST['recherch_emp'])) {
            $data = array();

            $id = $_SESSION['id'];
            $data['id'] = $id;
            $id_service = $_SESSION['id_service'];
            $data['id_service'] = $id_service;
            $emplo = Employe::getAdminacce($data);
            return $emplo;
        }
    }
    public function getonedm()
    {
        $data = array();

        if (isset($_POST['rech'])) {
            $rech = $_POST['rech'];
            $data['rech'] = $rech;
            $id = $_SESSION['id'];
            $data['id'] = $id;
            $id_service = $_SESSION['id_service'];
            $data['id_service'] = $id_service;
            $emplo = Employe::getAdminOne($data);
            return $emplo;
        }
    }
    public  function getuser()
    {
        if (isset($_POST['recherch_emp'])) {
            $data = array();

            $id = $_SESSION['id'];
            $data['id'] = $id;
            $id_service = $_SESSION['id_service'];
            $data['id_service'] = $id_service;
            $emplo = Employe::getuseracce($data);
            return $emplo;
        }
    }
    public  function getuserOn()
    {
        $data = array();
        if (isset($_POST['rech'])) {
            $rech = $_POST['rech'];
            $data['rech'] = $rech;
            $id = $_SESSION['id'];
            $data['id'] = $id;
            $id_service = $_SESSION['id_service'];
            $data['id_service'] = $id_service;
            $emplo = Employe::getuserOne($data);
            return $emplo;
        }
    }
}
