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
    public static function getServiceModele()
    {
        $stmtServices = db::connect()->prepare("SELECT * FROM service");
        $stmtServices->execute();
        $services = $stmtServices->fetchAll();
        return $services;
    }
    public static function getAll($id, $id_service)
    {
        $stmt = db::connect()->prepare("    
        SELECT e.*, s.nom_service,
         d.nom_structure
          FROM employer e JOIN service s ON e.id_service = s.id_service 
          JOIN structure d
 ON s.id_Structure = d.id_Structure
         WHERE e.id_service = ? AND type !='Administrateur' AND id !=?; 
        ");
        $stmt->execute(array($id_service, $id));
        return $stmt->fetchAll();

        $stmt = null;
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
        $id = $data['id'];
        try {
            $stmt = db::connect()->prepare("
                SELECT e.*, s.nom_service, d.nom_structure,d.id_structure
                FROM employer e 
                JOIN service s ON e.id_service = s.id_service 
                JOIN structure d ON s.id_structure = d.id_structure
                WHERE e.id = ?
            ");
            $stmt->execute(array($id)); // N'oubliez pas d'exécuter la requête ici
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




    public static function edit($data)
    {
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
        section = :section,
        date_entre = :date_entre,
        motif_entre = :motif_entre
        /*id_service = :id_service*/
        WHERE id = :id");

        $requiredKeys = ['nom', 'prenom', 'ssn', 'sexe', 'sf', 'date_nais', 'nbr_enft', 'invalid', 'status', 'position', 'poste', 'grade', 'qualif', 'categorie', 'section', 'date_entre', 'motif_entre', 'id'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                die("La clé manquante dans \$data : $key");
            }

            // Liaison des paramètres individuels
            $stmt->bindValue(":$key", $data[$key]);
        }

        // Exécutez la requête
        $res = $stmt->execute();

        // Mettez à jour le nom du service si disponible
        /* if (isset($data['id_service'])) {
            $stmtService = $db->prepare("UPDATE service SET id_structure = :id_structure WHERE id_service = :id_service");
            $stmtService->bindValue(':id_structure', $data['id_structure']);
            $stmtService->bindValue(':id_service', $data['id_service']);
            $stmtService->execute();
        }*/

        // ... Autres opérations si nécessaires

        if ($res) {
            return 'ok';
        } else {
            return 'error';
        }
    }


    // ... Autres fonctions de votre modèle


    public static function delete($data)
    {
        $mat = $data['mat'];
        $id = $data['id'];
        $sm = db::connect()->prepare("delete from employer where id = ? AND mat = ?");
        $sm->execute(array($id, $mat));
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
        $sm = db::connect()->prepare(" SELECT e.*, s.nom_service,
        d.nom_structure
         FROM employer e JOIN service s ON e.id_service = s.id_service 
         JOIN structure d
ON s.id_Structure = d.id_Structure
        WHERE e.id_service = ? AND e.type !='Administrateur' AND e.id !=? AND (nom LIKE ? OR prenom LIKE ?)
         ");
        $sm->execute(array($id_service, $id, "%$rech%", "%$rech%"));
        $employ = $sm->fetchAll();
        return $employ;
    }

    public static function getAdminacce($data)
    {
        $id_adm = $data['id'];
        $id_service = $data['id_service'];

        $stm = db::connect()->prepare("SELECT e.*, s.nom_service, d.nom_structure,d.id_structure
        FROM employer e 
        JOIN service s ON e.id_service = s.id_service 
        JOIN structure d ON s.id_structure = d.id_structure
            WHERE (e.type='admin' OR (e.type='user' AND e.id_service=?) or e.type='Administrateur')
            AND (id != ?)");
        $stm->execute(array($id_service, $id_adm));
        $employ = $stm->fetchAll();
        return $employ;
    }
    public static function getAdminOne($data)
    {
        $id_adm = $data['id'];
        $id_service = $data['id_service'];
        $rech = $data['rech'];
        $stm = db::connect()->prepare("SELECT e.*, s.nom_service, d.nom_structure,d.id_structure
        FROM employer e 
        JOIN service s ON e.id_service = s.id_service 
        JOIN structure d ON s.id_structure = d.id_structure
            WHERE (e.type='admin' OR (e.type='user' AND e.id_service=?)or e.type='Administrateur')
            AND (id != ?) AND(nom LIKE ? OR prenom LIKE ?)");
        $stm->execute(array($id_adm, $id_service, "%$rech%", "%$rech%"));
        $employ = $stm->fetchAll();
        return $employ;
    }

    public static function getuseracce($data)
    {
        $id_service = $data['id_service'];
        $id = $data['id'];

        $stm = db::connect()->prepare("SELECT e.*, s.nom_service, d.nom_structure,d.id_structure
        FROM employer e 
        JOIN service s ON e.id_service = s.id_service 
        JOIN structure d ON s.id_structure = d.id_structure
            WHERE ((e.type='admin' AND e.id_service=? )OR (e.type='user' AND e.id_service=?))
            AND id != ?");
        $stm->execute(array($id_service, $id_service, $id));
        $employ = $stm->fetchAll();
        return $employ;
    }
    public static function getuserOne($data)
    {
        $id_service = $data['id_service'];
        $id = $data['id'];
        $rech = $data['rech'];
        $stm = db::connect()->prepare("SELECT e.*, s.nom_service, d.nom_structure,d.id_structure
        FROM employer e 
        JOIN service s ON e.id_service = s.id_service 
        JOIN structure d ON s.id_structure = d.id_structure
            WHERE ((e.type='admin' AND e.id_service=? )OR (e.type='user' AND e.id_service=?))
            AND id != ?AND(nom LIKE ? OR prenom LIKE ?)");
        $stm->execute(array($id_service, $id_service, $id, "%$rech%", "%$rech%"));
        $employ = $stm->fetchAll();
        return $employ;
    }

    public static function addEmp($data)
    {
        $db = db::connect();

        $stmt = $db->prepare("INSERT INTO employer (
        id, mat, password, type, id_adm, nom, prenom, ssn, sexe, sf, date_nais, nbr_enft, 
        invalid, status, position, poste, grade, qualif, categorie, section, 
        date_entre, motif_entre, id_service
    ) VALUES (
        :id, :mat, :password, :type, :id_adm, :nom, :prenom, :ssn, :sexe, :sf, :date_nais, :nbr_enft, 
        :invalid, :status, :position, :poste, :grade, :qualif, :categorie, :section, 
        :date_entre, :motif_entre, :id_service
    )");

        $requiredKeys = ['id', 'mat', 'password', 'type', 'id_adm', 'nom', 'prenom', 'ssn', 'sexe', 'sf', 'date_nais', 'nbr_enft', 'invalid', 'status', 'position', 'poste', 'grade', 'qualif', 'categorie', 'section', 'date_entre', 'motif_entre', 'id_service'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                die("La clé manquante dans \$data : $key");
            }

            // Liaison des paramètres individuels
            $stmt->bindValue(":$key", $data[$key]);
        }

        // Exécutez la requête
        $res = $stmt->execute();

        if ($res) {
            return 'ok';
        } else {
            return 'error';
        }
    }
}
