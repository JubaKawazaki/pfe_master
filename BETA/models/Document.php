<?php
class Document
{
    public static function add_document($data)
    {
        $date = date('y-m-d H:i:s');
        $id_createur = $data['id_createur'];
        $mat_createur = $data['mat_createur'];
        $nom_doc = $data['nom_doc'];
        $lien_acd = $data['lien_acd'];
        $file_tmp = $data['file_tmp'];

        $db = db::connect();
        $stmt = $db->prepare("INSERT INTO document (id_createur, mat_createur, nom_doc, lien_acd, date_creation, last_accessed, archived) 
        VALUES (?, ?, ?, ?, ?, ?, 0)"); // Initialiser archived à 0 lors de la création du document
        $stmt->execute((array($id_createur, $mat_createur, $nom_doc, $lien_acd, $date, $date)));
        if ($stmt->rowCount() > 0) {
            move_uploaded_file($file_tmp, $lien_acd);
            return true;
        } else {
            return false;
        }
    }
    public static function getCreatedDocuments($data)
    {
        $id = $data['id_createur'];
        $mat = $data['mat_createur'];
        $stm = db::connect()->prepare("SELECT * FROM document WHERE id_createur = ? AND mat_createur = ? AND archived = 0");
        $stm->execute(array($id, $mat));
        return $stm->fetchAll();
    }
    public static function getArchivedDocuments($data)
    {
        $id = $data['id_createur'];
        $mat = $data['mat_createur'];
        $stm = db::connect()->prepare("SELECT * FROM document WHERE id_createur = ? AND mat_createur = ? AND archived = 1");
        $stm->execute(array($id, $mat));
        return $stm->fetchAll();
    }
    public static function recharchArch($data)
    {
        $rech = $data['rech_doc'];
        $id = $data['id_createur'];
        $sm = db::connect()->prepare("SELECT * FROM document WHERE (SUBSTRING_INDEX(nom_doc, '.', 1) LIKE ?)
         AND id_createur = ? AND archived = 1");
        $sm->execute(array("%$rech%", $id));
        $documents = $sm->fetchAll();
        return $documents;
    }
    public static function recharchdoc($data)
    {
        $rech = $data['rech_doc'];
        $id = $data['id_createur'];
        $sm = db::connect()->prepare("SELECT * FROM document WHERE (SUBSTRING_INDEX(nom_doc, '.', 1) LIKE ?)
         AND id_createur = ? AND archived = 0");
        $sm->execute(array("%$rech%", $id));
        $documents = $sm->fetchAll();
        return $documents;
    }
    public static function recharchdocRecu($id_user, $nom_doc)
    {
        $stm = db::connect()->prepare("SELECT DISTINCT b.*, a.id_createur FROM `document_partager` a, `document` b WHERE id_emp_recu=? AND a.`id_createur` = b.id_createur AND a.`id_doc` = b.id_doc AND (SUBSTRING_INDEX(nom_doc, '.', 1) LIKE ?)");

        $stm->execute(array($id_user, "%$nom_doc%"));
        return $stm->fetchAll();
    }
    public static function updateLastAccessed($document_id)
    {
        $db = db::connect();
        $stmt = $db->prepare("UPDATE document SET last_accessed = ? WHERE id_doc = ?");
        $current_date = date('y-m-d H:i:s');
        $stmt->execute(array($current_date, $document_id));
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function envoie_doc($data)
    {
        var_dump($data);
        $id_doc = $data['id_doc'];
        $id_createur = $_SESSION['id'];
        $id_emp_recu = $data['id_emp_recu'];
        $date = date('y-m-d H:i:s');
        $db = db::connect();
        $stmt = $db->prepare("INSERT INTO document_partager (id_doc,id_createur,id_emp_recu,date_envoie) 
        VALUES (?, ?, ?, ?)"); // Initialiser archived à 0 lors de la création du document
        $stmt->execute((array($id_doc, $id_createur, $id_emp_recu, $date)));
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getReceivedDocuments($id_user)
    {
        $stm = db::connect()->prepare("SELECT  b.*, a.id_createur FROM `document_partager` a, `document` b WHERE id_emp_recu=? AND a.`id_createur` = b.id_createur AND a.`id_doc` = b.id_doc ");
        $stm->execute(array($id_user));
        return $stm->fetchAll();
    }

    public static function getSenderInfo($id_sender)
    {
        $ldd = db::connect()->prepare("SELECT nom, prenom FROM employer WHERE id=? ");
        $ldd->execute(array($id_sender));
        return $ldd->fetch();
    }

    public static function  getSentDate($id_doc, $id_sender, $id_receiver)
    {
        $zd = db::connect()->prepare("SELECT date_envoie FROM document_partager WHERE id_doc=? AND id_createur=? AND id_emp_recu=? ");
        $zd->execute(array($id_doc, $id_sender, $id_receiver));
        return $zd->fetch()['date_envoie'];
    }
    public static function Archive($data)
    {
        $id_doc = $data['id_doc'];
        $db = db::connect();
        $stmt = $db->prepare("UPDATE document SET archived  = 1 WHERE id_doc = ?");
        $current_date = date('y-m-d H:i:s');
        $stmt->execute(array($id_doc));
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function nombre_doc_partages($data)
    {
        $id = $data['id'];
        $db = db::connect();
        $stmt = $db->prepare("SELECT COUNT(id_createur) AS nombre_partages FROM document_partager WHERE id_createur = ?");
        $stmt->execute(array($id));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $nombrePartages = $result['nombre_partages'];

        // Vous pouvez utiliser $nombrePartages comme nécessaire
        return $nombrePartages;
    }
    public static function nombre_doc($data)
    {
        $id = $data['id'];
        $db = db::connect();
        $stmt = $db->prepare("SELECT COUNT(*) AS nombre_partages  FROM document WHERE id_createur=? AND archived=0");
        $stmt->execute(array($id));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $nombrePartages = $result['nombre_partages'];

        // Vous pouvez utiliser $nombrePartages comme nécessaire
        return $nombrePartages;
    }
}
