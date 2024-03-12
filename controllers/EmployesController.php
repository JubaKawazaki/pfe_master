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
    public function getSectionControolr()
    {
        $section = Employe::getSectionModele();
        return $section;
    }
    public function getAllEmployes()
    {
        $id_service =  $_SESSION['id_service'];
        $mat =  $_SESSION['mat'];
        $employes = Employe::getAll($mat, $id_service);
        return $employes;
    }
    public function getOnsection()
    {
        $data = array();
        $id_service = $_SESSION['id_service'];
        $data['id_service'] = $id_service;
        $section = Employe::getSectionModeleOne($data);
        return $section;
    }
    public function getOnsectione()
    {
        $data = array();

        if (isset($_POST['updateuse']) or isset($_POST['update'])) {
            $id_service = $_POST['id_service'];
            $data['id_service'] = $id_service;
            $section = Employe::getSectionModeleOne($data);
            return $section;
        }
    }





    public function getOneEmploye()
    {
        $data = array();

        if (isset($_POST['mat'])) {
            $mat = $_POST['mat'];
            $data['mat'] = $mat; // Ajoutez 'id' au tableau $data

            $employ = Employe::getEmployes($data);
            return $employ;
        }
    }
    public function adduser()
    {
        if (isset($_POST['ajouter_Emp'])) {
            $formattedDate = date('ymd', strtotime($_POST['date_entre']));
            $incrementalNumber = Employe::getIncrementalNumber();
            $mat = sprintf("%04d%s", $incrementalNumber, $formattedDate);

            $employe = new Employer();
            $employe->setMat($mat); // Utilisez la fonction de génération de matricule
            $employe->setPassword($_POST['password']);
            $employe->setNom($_POST['nom']);
            $employe->setPrenom($_POST['prenom']);
            $employe->setSsn($_POST['ssn']);
            $employe->setSexe($_POST['sexe']);
            $employe->setSf($_POST['sf']);
            $employe->setType('user');
            $employe->setDateNais($_POST['date_naiss']);
            $employe->setNbrEnft($_POST['nbr_enft']);
            $employe->setInvalid($_POST['invalid']);
            $employe->setStatus($_POST['status']);
            $employe->setPosition($_POST['position']);
            $employe->setGrade($_POST['grade']);
            $employe->setPoste($_POST['poste']);
            $employe->setQualif($_POST['qualif']);
            $employe->setCategorie($_POST['categorie']);

            $employe->setDateEntre($_POST['date_entre']);
            $employe->setMotifEntre($_POST['motif_entre']);
            $employe->setIdService($_SESSION['id_service']);

            // Appel de la méthode addEmp avec l'objet Employe
            $resultat = Employe::addEmp($employe);

            if ($resultat == 'ok') {
                Session::set('success', 'Employer ajouté avec succès');
                Redirect::to('listemp');
            } else {
                Session::set('error', 'Erreur lors de l\'ajout de l\'Employer');
                Redirect::to('addEmp'); // Assurez-vous de rediriger vers la bonne page en cas d'erreur
            }
        }
    }


    public function update()
    {
        if (isset($_POST['upduser'])) {

            $employe = new Employer();
            $employe->setMat($_POST['mat']);
            $employe->setIdService($_SESSION['id_service']);
            $employe->setNom($_POST['nom']);
            $employe->setPrenom($_POST['prenom']);
            $employe->setSsn($_POST['ssn']);
            $employe->setSexe($_POST['sexe']);
            $employe->setSf($_POST['sf']);
            $employe->setDateNais($_POST['date_naiss']);
            $employe->setNbrEnft($_POST['nbr_enft']);
            $employe->setInvalid($_POST['invalid']);
            $employe->setStatus($_POST['status']);
            $employe->setPosition($_POST['position']);
            $employe->setPoste($_POST['poste']);
            $employe->setGrade($_POST['grade']);
            $employe->setQualif($_POST['qualif']);
            $employe->setCategorie($_POST['categorie']);
            $employe->setDateEntre($_POST['date_entre']);
            $employe->setMotifEntre($_POST['motif_entre']);

            $resultat = Employe::edit($employe);

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

        if (isset($_POST['mat'])) {

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

            $mat = $_SESSION['mat'];
            $data['mat'] = $mat;
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
            $mat = $_SESSION['mat'];
            $data['mat'] = $mat;
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

            $id = $_SESSION['mat'];
            $data['mat'] = $id;
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
            $mat = $_SESSION['mat'];
            $data['mat'] = $mat;
            $id_service = $_SESSION['id_service'];
            $data['id_service'] = $id_service;
            $emplo = Employe::getuserOne($data);
            return $emplo;
        }
    }
    public function changepasswordcontroller()
    {
        $data = array();
        $data['ancpwd'] = $_POST['oldPassword'];
        $data['nvpwd'] = $_POST['newPassword'];
        $data['mat'] = $_SESSION['mat'];
        $reponse = Employe::changepasswords($data);
        return $reponse;
    }
}
