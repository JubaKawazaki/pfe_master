<?php
class Admins
{
    public  static function addAdmin($data)
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

        // Liaison des paramètres individuels
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $res = $stmt->execute();

        if ($res) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    public static function recharchAdm($data)
    {
        $rech = $data['rech'];

        try {
            $sm = db::connect()->prepare("
                SELECT e.*, s.nom_service, d.nom_structure
                FROM employer e 
                JOIN service s ON e.id_service = s.id_service 
                JOIN structure d ON s.id_structure = d.id_structure
                WHERE e.type = 'admin'  AND (e.nom LIKE ? OR e.prenom LIKE ?)
            ");
            $sm->execute(array("%$rech%", "%$rech%"));
            $employ = $sm->fetchAll();
            return $employ;
        } catch (PDOException $ex) {
            // Gérez l'erreur de manière appropriée, comme logger l'erreur ou afficher un message à l'utilisateur.
            echo 'Erreur lors de l\'exécution de la requête : ' . $ex->getMessage();
            return null; // Vous pouvez également retourner null ou une valeur par défaut en cas d'erreur.
        }
    }
    public static function recharchEmp($data)
    {
        $rech = $data['rech'];


        try {
            $sm = db::connect()->prepare("
                SELECT e.*, s.nom_service, d.nom_structure
                FROM employer e 
                JOIN service s ON e.id_service = s.id_service 
                JOIN structure d ON s.id_structure = d.id_structure
                WHERE e.type = 'user'  AND (e.nom LIKE ? OR e.prenom LIKE ?)
            ");
            $sm->execute(array("%$rech%", "%$rech%"));
            $employ = $sm->fetchAll();
            return $employ;
        } catch (PDOException $ex) {
            // Gérez l'erreur de manière appropriée, comme logger l'erreur ou afficher un message à l'utilisateur.
            echo 'Erreur lors de l\'exécution de la requête : ' . $ex->getMessage();
            return null; // Vous pouvez également retourner null ou une valeur par défaut en cas d'erreur.
        }
    }

    public static function getAllAdminInfo()
    {
        $db = db::connect();

        $query = $db->prepare("
           
        SELECT e.*, s.nom_service,
         d.nom_structure
          FROM employer e JOIN service s ON e.id_service = s.id_service 
          JOIN structure d
 ON s.id_Structure = d.id_Structure
         WHERE e.type = 'admin'; 
        ");

        $query->execute();

        return $query->fetchAll();
    }
    public static function getAlluserInfo()
    {
        $db = db::connect();

        $query = $db->prepare("
           
        SELECT e.*, s.nom_service,
         d.nom_structure
          FROM employer e JOIN service s ON e.id_service = s.id_service 
          JOIN structure d
 ON s.id_Structure = d.id_Structure
         WHERE e.type = 'user'; 
        ");

        $query->execute();

        return $query->fetchAll();
    }
    public static function editADS($data)
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
}
