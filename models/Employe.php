<?php
class Employe
{
    public static function getStructureModele()
    {
        $stmtStructures = db::connect()->prepare("SELECT * FROM structure");
        $stmtStructures->execute();
        $structures = $stmtStructures->fetchAll();
        return $structures;
    }
    public static function getSectionModele()
    {
        $stmtStructures = db::connect()->prepare("SELECT * FROM section");
        $stmtStructures->execute();
        $section = $stmtStructures->fetchAll();
        return $section;
    }
    public static function getSectionModeleOne($data)
    {
        $id_service = $data['id_service'];
        $stmtSection = db::connect()->prepare("SELECT * FROM section where id_service= ?");
        $stmtSection->execute(array($id_service));
        $section = $stmtSection->fetchAll();
        return $section;
    }
    public static function getServiceModele()
    {
        $stmtServices = db::connect()->prepare("SELECT * FROM service");
        $stmtServices->execute();
        $services = $stmtServices->fetchAll();
        return $services;
    }

    public static function getAll($mat, $id_service)
    {
        $stmt = db::connect()->prepare("
            SELECT e.*, s.*, d.nom_structure, d.id_structure
            FROM employer e 
            JOIN service s ON e.id_service = s.id_service 
            JOIN structure d ON s.id_structure = d.id_structure
            WHERE s.id_service = ? AND e.type != 'Administrateur' AND e.mat != ?;
        ");
        $stmt->execute(array($id_service, $mat));
        $result = $stmt->fetchAll();

        return $result;
    }



    public static function getAlluser()
    {
        $stmt = db::connect()->prepare("select * from employer where type='user'");
        $stmt->execute();
        return $stmt->fetchAll();

        $stmt = null;
    }
    public static function getEmployes($data)

    {

        $structures = Employe::getStructureModele();
        $services = Employe::getServiceModele();

        $mat = $data['mat'];
        try {
            $stmt = db::connect()->prepare("
            SELECT e.*, s.nom_service, d.nom_structure, d.id_structure
            FROM employer e 
          
            JOIN service s ON e.id_service = s.id_service 
            JOIN structure d ON s.id_structure = d.id_structure
            WHERE e.mat = ?
        ");
            $stmt->execute(array($mat));
            $employ = $stmt->fetch(PDO::FETCH_OBJ);

            if ($employ) {
                $employ->structures = $structures;
                $employ->services = $services;

                return $employ;
            }
        } catch (PDOException $ex) {
            echo 'error' . $ex->getMessage();
            // Gérez l'erreur de manière appropriée, comme logger l'erreur ou afficher un message à l'utilisateur.
            return null; // Vous pouvez également retourner null ou une valeur par défaut en cas d'erreur.
        }
    }




    public static function edit(Employer $employe)
    {
        try {
            $db = db::connect();

            $stmt = $db->prepare("UPDATE employer SET 
                nom = :nom,
                prenom = :prenom,
                ssn = :ssn,
                sexe = :sexe,
                sf = :sf,
                date_nais = :date_nais,
                nbr_enft = :nbr_enft,
                invalid = :invalid,
                status = :status,
                position = :position,
                poste = :poste,
                grade = :grade,
                qualif = :qualif,
                categorie = :categorie,
                date_entre = :date_entre,
                motif_entre = :motif_entre,
                id_service = :id_service
                WHERE mat = :mat");

            // Utilisation des getters pour récupérer les valeurs des attributs de l'objet Employe
            $stmt->bindValue(":mat", $employe->getMat());
            $stmt->bindValue(":nom", $employe->getNom());
            $stmt->bindValue(":prenom", $employe->getPrenom());
            $stmt->bindValue(":ssn", $employe->getSsn());
            $stmt->bindValue(":sexe", $employe->getSexe());
            $stmt->bindValue(":sf", $employe->getSf());
            $stmt->bindValue(":date_nais", $employe->getDateNais());
            $stmt->bindValue(":nbr_enft", $employe->getNbrEnft());
            $stmt->bindValue(":invalid", $employe->getInvalid());
            $stmt->bindValue(":status", $employe->getStatus());
            $stmt->bindValue(":position", $employe->getPosition());
            $stmt->bindValue(":poste", $employe->getPoste());
            $stmt->bindValue(":grade", $employe->getGrade());
            $stmt->bindValue(":qualif", $employe->getQualif());
            $stmt->bindValue(":categorie", $employe->getCategorie());
            $stmt->bindValue(":date_entre", $employe->getDateEntre());
            $stmt->bindValue(":motif_entre", $employe->getMotifEntre());
            $stmt->bindValue(":id_service", $employe->getIdService());

            // Exécutez la requête
            $stmt->execute();

            return 'ok';
        } catch (PDOException $e) {
            // Gérer l'erreur de manière appropriée (journalisation, affichage à l'utilisateur, etc.)
            return 'error';
        }
    }

    // ... Autres fonctions de votre modèle


    public static function delete($data)
    {
        $mat = $data['mat'];

        $sm = db::connect()->prepare("delete from employer where  mat = ?");
        $sm->execute(array($mat));
        if ($sm->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    public static function recharchEmp($data)
    {
        $rech = $data['rech'];

        $id_service = $data['id_service'];
        $id = $_SESSION['id'];
        $sm = db::connect()->prepare(" SELECT e.*, s.*, sec.nom_section, d.nom_structure, d.id_structure
        FROM employer e 
        JOIN section sec ON e.id_section = sec.id_section
        JOIN service s ON sec.id_service = s.id_service 
        JOIN structure d ON s.id_structure = d.id_structure
        WHERE s.id_service = ? AND e.type !='Administrateur' AND e.id !=? AND (nom LIKE ? OR prenom LIKE ?)
         ");
        $sm->execute(array($id_service, $id, "%$rech%", "%$rech%"));
        $employ = $sm->fetchAll();
        return $employ;
    }
    public static function getAdminacce($data)
    {
        $mat = $data['mat'];
        $id_service = $data['id_service'];

        $stm = db::connect()->prepare("SELECT e.*, s.*, d.*
            FROM employer e 
          
            JOIN service s ON e.id_service = s.id_service 
            JOIN structure d ON s.id_structure = d.id_structure
            WHERE (e.type='admin' OR e.type='Administrateur' OR (e.type='user' AND e.id_service=?))
                AND e.mat != ?");
        $stm->execute(array($id_service, $mat));
        $employ = $stm->fetchAll();
        return $employ;
    }

    public static function getAdminOne($data)
    {
        $mat = $data['mat'];
        $id_service = $data['id_service'];
        $rech = $data['rech'];
        $stm = db::connect()->prepare("SELECT e.*, s.nom_service, d.nom_structure, d.id_structure
        FROM employer e 
      
        JOIN service s ON e.id_service = s.id_service 
        JOIN structure d ON s.id_structure = d.id_structure
            WHERE (e.type='admin' OR (e.type='user' AND s.id_service=?)or e.type='Administrateur')
            AND (mat != ?) AND(nom LIKE ? OR prenom LIKE ?)");
        $stm->execute(array($id_service, $mat, "%$rech%", "%$rech%"));
        $employ = $stm->fetchAll();
        return $employ;
    }

    public static function getuseracce($data)
    {
        $id_service = $data['id_service'];
        $mat = $data['mat'];

        $stm = db::connect()->prepare("SELECT e.*, s.nom_service, d.nom_structure, d.id_structure
            FROM employer e 
            JOIN service s ON e.id_service = s.id_service 
            JOIN structure d ON s.id_structure = d.id_structure
            WHERE ((e.type='admin' AND s.id_service=?) OR (e.type='user' AND s.id_service=?))
                AND e.mat != ?");
        $stm->execute(array($id_service, $id_service, $mat));
        $employ = $stm->fetchAll();
        return $employ;
    }

    public static function getuserOne($data)
    {
        $id_service = $data['id_service'];
        $mat = $data['mat'];
        $rech = $data['rech'];
        $stm = db::connect()->prepare("SELECT e.*, s.nom_service, d.nom_structure, d.id_structure
        FROM employer e 
        JOIN service s ON e.id_service = s.id_service 
        JOIN structure d ON s.id_structure = d.id_structure
            WHERE ((e.type='admin' AND e.id_service=? )OR (e.type='user' AND e.id_service=?))
            AND mat != ?AND(nom LIKE ? OR prenom LIKE ?)");
        $stm->execute(array($id_service, $id_service, $mat, "%$rech%", "%$rech%"));
        $employ = $stm->fetchAll();
        return $employ;
    }

    public static function addEmp(Employer $employe)
    {
        $db = db::connect();

        $stmt = $db->prepare("INSERT INTO employer (
             mat, password, type, nom, prenom, ssn, sexe, sf, date_nais, nbr_enft, 
            invalid, status, position, poste, grade, qualif, categorie,
            date_entre, motif_entre,id_service
        ) VALUES (
             :mat, :password, :type, :nom, :prenom, :ssn, :sexe, :sf, :date_nais, :nbr_enft, 
            :invalid, :status, :position, :poste, :grade, :qualif, :categorie, 
            :date_entre, :motif_entre, :id_service
        )");

        // Utilisation des getters pour récupérer les valeurs des attributs de l'objet Employe

        $stmt->bindValue(":mat", $employe->getMat());
        $stmt->bindValue(":password", $employe->getPassword());
        $stmt->bindValue(":type", $employe->getType());
        $stmt->bindValue(":nom", $employe->getNom());
        $stmt->bindValue(":prenom", $employe->getPrenom());
        $stmt->bindValue(":ssn", $employe->getSsn());
        $stmt->bindValue(":sexe", $employe->getSexe());
        $stmt->bindValue(":sf", $employe->getSf());
        $stmt->bindValue(":date_nais", $employe->getDateNais());
        $stmt->bindValue(":nbr_enft", $employe->getNbrEnft());
        $stmt->bindValue(":invalid", $employe->getInvalid());
        $stmt->bindValue(":status", $employe->getStatus());
        $stmt->bindValue(":position", $employe->getPosition());
        $stmt->bindValue(":poste", $employe->getPoste());
        $stmt->bindValue(":grade", $employe->getGrade());
        $stmt->bindValue(":qualif", $employe->getQualif());
        $stmt->bindValue(":categorie", $employe->getCategorie());
        $stmt->bindValue(":id_service", $employe->getIdService());
        $stmt->bindValue(":date_entre", $employe->getDateEntre());
        $stmt->bindValue(":motif_entre", $employe->getMotifEntre());


        // Exécutez la requête
        $res = $stmt->execute();

        if ($res) {
            return 'ok';
        } else {
            return 'error';
        }
    }


    public static function changepasswords($data)
    {
        $id = $data['id'];
        $ancienpwd = $data['ancpwd'];
        $nvpwd = $data['nvpwd'];

        $db = db::connect();

        $stmt = $db->prepare("UPDATE employer SET password = :nvpwd WHERE id = :id AND password = :ancienpwd");

        // Liaison des paramètres individuels
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":ancienpwd", $ancienpwd);
        $stmt->bindValue(":nvpwd", $nvpwd);

        // Exécution de la requête
        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
    public static function getIncrementalNumber()
    {
        $db = db::connect();

        // Récupérer le nombre d'employés déjà enregistrés dans la base de données
        $query = "SELECT COUNT(*) as count FROM employer";
        $result = $db->query($query);

        // Vérifier si la requête a réussi
        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $count = $row['count'];

            // Ajouter 1 pour obtenir le prochain nombre incrémentiel
            $incrementalNumber = $count + 1;

            // Fermer la connexion à la base de données
            $db = null;

            return $incrementalNumber;
        } else {
            die('Erreur lors de la récupération du nombre incrémentiel');
        }
    }
}
