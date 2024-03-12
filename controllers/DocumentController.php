<?php
class DocumentController
{

    public static function addDocument()
    {

        if (isset($_POST['ajouter']) && isset($_FILES['dff'])) {
            $mat_createur = $_SESSION['mat'];
            $size = $_FILES['dff']['size'];
            $file = $_FILES["dff"]["name"];

            if ($size > 41943040) {
                Session::set('error', 'La taille du document est très volumineuse');
                Redirect::to('listdoc');
            }

            $file_tmp = $_FILES["dff"]["tmp_name"];
            $file_dest = "Docs/" . $file;
            $data = array(

                'mat_createur' => $mat_createur,
                'file_tmp' => $file_tmp,
                'lien_acd' => $file_dest,
                'nom_doc' => $file
            );


            if (Document::add_document($data)) {
                Session::set('success', 'document ajouter Ajouter');
                Redirect::to('listdoc');
            } else {
                Session::set('error', 'La taille du document est très volumineuse');
                Redirect::to('listdoc');
            }
        }
    }
    public static function getDocumentsCreate()
    {
        $mat_createur = $_SESSION['mat'];
        $data = array(

            'mat_createur' => $mat_createur
        );
        $documents = Document::getCreatedDocuments($data);
        return $documents;
    }
    public static function getDocumentsArchived()
    {

        $mat_createur = $_SESSION['mat'];
        $data = array(

            'mat_createur' => $mat_createur
        );
        $documents = Document::getArchivedDocuments($data);
        return $documents;
    }
    public function findDoc()
    {

        $data = array();

        if (isset($_POST['rech_doc'])) {
            $mat_createur = $_SESSION['mat'];
            $rech = $_POST['rech_doc'];
            $data['rech_doc'] = $rech;  // Correction de la clé
            $data['mat_createur'] = $mat_createur;  // Correction de la clé
        }
        $documents = Document::recharchdoc($data);
        return $documents;
    }
    public function findArch()
    {

        $data = array();

        if (isset($_POST['rech_doc'])) {
            $id_createur = $_SESSION['id'];
            $rech = $_POST['rech_doc'];
            $data['rech_doc'] = $rech;  // Correction de la clé
            $data['id_createur'] = $id_createur;  // Correction de la clé
        }
        $documents = Document::recharchArch($data);
        return $documents;
    }
    public function updateLastAccessed($documentId)
    {
        $res = Document::updateLastAccessed($documentId);
        $response = array();

        if ($res) {
            $response['success'] = true;
            $response['message'] = 'Date modifiée.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Erreur lors de la modification de la date.';
        }

        // Envoi de la réponse JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }


    public function partage_doc()
    {
        $data = array();
        $id_doc = $_POST['id_doc'];
        $selectedEmployees = isset($_POST['selectedEmployees']) ? $_POST['selectedEmployees'] : [];

        if (empty($selectedEmployees)) {
            // Cas 1: Aucun employé sélectionné individuellement
            if (isset($_POST['id_emp'])) {
                // Envoyer le document uniquement à cet employé
                $mat_emp_recu = $_POST['mat_emp'];
                $data['id_doc'] = $id_doc;
                $data['mat_emp_recu'] = $mat_emp_recu;
                $data['mat_createur'] = $_SESSION['mat'];
                $res = Document::envoie_doc($data);

                if (!$res) {
                    Session::set('error', 'Échec de l\'envoi du document à l\'employé sélectionné.');
                } else {
                    Session::set('success', 'Document bien envoyé à l\'employé sélectionné.');
                }
            } else {
                Session::set('error', 'Veuillez sélectionner au moins un employé.');
            }
        } else {
            // Cas 2: Plusieurs employés sélectionnés
            foreach ($selectedEmployees as $id_emp_recu) {
                $data['id_doc'] = $id_doc;
                $data['mat_emp_recu'] = $id_emp_recu;
                $data['mat_createur'] = $_SESSION['mat'];
                $res = Document::envoie_doc($data);

                if (!$res) {
                    Session::set('error', 'Échec de l\'envoi du document à certains employés.');
                    Redirect::to('documents'); // Rediriger immédiatement en cas d'erreur
                    return;
                }
            }

            Session::set('success', 'Document bien envoyé aux employés sélectionnés.');
        }

        // Redirection à la fin du traitement (si aucune erreur n'a été rencontrée)
        Redirect::to('documents');
    }


    public function displayReceivedDocuments()
    {

        $receivedDocuments = Document::getReceivedDocuments($_SESSION['mat']);

        // Ajout de données supplémentaires si nécessaire
        foreach ($receivedDocuments as &$document) {
            $senderInfo = Document::getSenderInfo($document['mat_createur']);
            $sentDate =  Document::getSentDate($document['id_doc'], $document['mat_createur'], $_SESSION['mat']);
            $document['sender_name'] = $senderInfo['nom'] . ' ' . $senderInfo['prenom'];
            $document['sent_date'] = $sentDate;
        }

        return $receivedDocuments;
    }
    public function findDocRecu()
    {
        $receivedDocuments = Document::recharchdocRecu($_SESSION['id'], $_POST['rech_doc']);

        // Ajout de données supplémentaires si nécessaire
        foreach ($receivedDocuments as &$document) {
            $senderInfo = Document::getSenderInfo($document['id_createur']);
            $sentDate =  Document::getSentDate($document['id_doc'], $document['id_createur'], $_SESSION['id']);
            $document['sender_name'] = $senderInfo['nom'] . ' ' . $senderInfo['prenom'];
            $document['sent_date'] = $sentDate;
        }

        return $receivedDocuments;
    }
    public function Archivedoc()
    {
        $data = array();
        if (isset($_POST['archiver'])) {

            $id_doc = $_POST['id'];

            $data['id_doc'] = $id_doc;
            $res = Document::Archive($data);
            if ($res) {
                Session::set('success', 'Document bien Archive.');
            } else {
                Session::set('error', 'Document non Archive.');
            }
            Redirect::to('documents');
        }
    }
    public function desArchivedoc()
    {
        $data = array();
        if (isset($_POST['desarchive'])) {

            $id_doc = $_POST['id_doc'];

            $data['id_doc'] = $id_doc;
            $res = Document::desArchive($data);
            if ($res) {
                Session::set('success', 'Document bien desArchive.');
            } else {
                Session::set('error', 'Document non desArchive.');
            }
            Redirect::to('DocumentArchive');
        }
    }
    public function nombre_doc_part()
    {
        $data = array();
        $mat = $_SESSION['mat'];
        $data['mat'] = $mat;
        $nbr = document::nombre_doc_partages($data);
        return $nbr;
    }
    public function nombre_do()
    {
        $data = array();
        $mat = $_SESSION['mat'];
        $data['mat'] = $mat;
        $nbr = document::nombre_doc($data);
        return $nbr;
    }
}
