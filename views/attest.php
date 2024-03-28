<?php

ob_start();

include 'assets/fpdf/fpdf.php';


// $references = array();
// function Reference()
// {

//     global $references;

//     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $numbers = '0123456789';
//     $randomString = '';

//     do {
//         $randomString = $characters[rand(0, strlen($characters) - 1)];

//         for ($i = 0; $i < 7; $i++) {
//             $randomString .= $numbers[rand(0, strlen($numbers) - 1)];
//         }
//     } while (in_array($randomString, $references));

//     $references[] = $randomString;

//     return $randomString;
// }


if (isset($_POST['envoyer'])) {

    $reference = 'REF-' . str_pad(uniqid(), 10, '0', STR_PAD_LEFT);

    $mat = $_POST['mat'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_nais = $_POST['date_naiss'];
    $poste = $_POST['poste'];
    $date_entre = $_POST['entre'];
    $motif_entre = $_POST['motif'];

    $pdf = new FPDF();
    $pdf->AddPage("P", "A4");

    $pdf->Image("assets/img/logo_saidal.png", 80, 6, 50, 30);
    $pdf->Ln(30);

    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(0, 10, "Sous Direction Administration", 0, 1);

    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(0, 5, $reference." /SDA /2024", 0, 1);

    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(0, 5, "Gue de Constantine le : " . date("d/m/y"), 0, 1, 'R');

    $pdf->Ln(15);

    $pdf->AddFont('georgiaz', 'BI', 'georgiaz.php');
    $pdf->SetFont("georgiaz", "BI", 27);
    $pdf->Cell(0, 10, "Attestation de Travail", 0, 1, "C");

    $pdf->Ln(20);

    $pdf->SetFont('Arial', '', 14);
    $pdf->MultiCell(0, 10, "Nous soussignes, Sous Directeur de l Administration du Site de Production Gue de Constantine du Groupe SAIDAL, attestons que : ", 0, 1);

    $pdf->Ln(5);

    $pdf->Cell(0, 10, "Nom & Prenom : " . $nom . " " . $prenom, 0, 1);
    $pdf->Cell(0, 10, "Ne(e) le :" . $date_nais, 0, 1);
    $pdf->Cell(0, 10, "Fonction(Poste) :" . $poste, 0, 1);

    $pdf->Ln(10);

    $pdf->MultiCell(0, 10, "Fait parti(e) du personnel de l Entreprise depuis le, " . $date_entre . " a ce jour, a titre " . $motif_entre . " .", 0, 1);

    $pdf->Ln(10);

    $pdf->MultiCell(0, 10, "En foi de quoi, nous lui delivrons la presente attestation pour servir et valoir  ce que de droit.", 0, 1);

    $filePath = 'Docs/'.$reference.'.pdf';
    $_SESSION['filePath'] = $filePath;
    $_SESSION['reference'] = $reference;

    $pdf->Output('F', $filePath);
    $doc = new DocumentController();
    $doc::saveDemande();
    ob_end_flush();

}

?>