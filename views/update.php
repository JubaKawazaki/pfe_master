<?php

$date = new EmployesController();
$emp = $date->getOneEmploye();
if (isset($_POST['upd'])) {
    if ($emp->type === 'admin') {
        $date = new AdminsController();
        $empp = $date->updateADMS();
    }
    if ($emp->type === 'user') {
        $date = new AdminsController();
        $empp = $date->updateADMSEMP();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/header.php'; ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?php echo BASE_URL; ?>Dashboard">
                <div class="logo-image-small">
                    <img src="assets/img/icon.png" width="60">
                </div>
                <div class="sidebar-brand-text mx-3">Saidal</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASE_URL; ?>Dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Workspace
            </div>

            <!-- Nav Item - Document Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-clipboard"></i>
                    <span>Documents</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>listdoc">Documents Personel</a>
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>partagedoc">Documents Recus</a>
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>archivedoc">Documents Archivés</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Demande Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Demandes</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <?php

                    $type = $_SESSION['type'];

                    if ($type === 'user' || $type === 'admin') {
                        include 'includes/dmndemp.php';
                    } else {
                        include 'includes/dmnd.php';
                    }

                    ?>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php

            if ($type === 'Administrateur') {
                include 'includes/gestion_dg.php';
            }
            if ($type === 'admin') {
                include 'includes/gestion_chef.php';
            }
            if ($type === 'user') {
                //rien n'a afficher
            }

            ?>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL; ?>editor">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Edition de texte</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['nom'] . '   ' . $_SESSION['prenom']; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <form method="POST" action="profil">
                                    <input type="hidden" name="id" value="<?= $_SESSION['id']; ?>">

                                    <button class="dropdown-item">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profil
                                    </button>
                                </form>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Modifier le mot de passe
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Mettre a jour les informations d'un Employé</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="container-fluid">
                        <div class="row" style="width: 105%;margin-left: 4%;">
                            <div class="col-md-offset-1 col-md-10">
                                <?php include './views/includes/alert.php' ?>
                                <div class="container">
                                    <form class="form" method="post">
                                        <input type="hidden" id="mat" value="<?= $emp->mat; ?>" name="mat" required>
                                        <h4><strong>Identification</strong></h4>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Matricule</label>
                                                <input type="number" id="mat" name="mat" value="<?= $emp->mat; ?>"
                                                    class="form-control" >
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>SSN</label>
                                                <select name="ssn" id="ssn" class="form-control" >
                                                    <option value="oui" <?php if ($emp->ssn == 'oui')
                                                        echo 'selected'; ?>>
                                                        Oui</option>
                                                    <option value="non" <?php if ($emp->ssn == 'non')
                                                        echo 'selected'; ?>>
                                                        Non</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Nom</label>
                                                <input type="text" id="nom" name="nom" value="<?= $emp->nom; ?>"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Prenom</label>
                                                <input type="text" id="prenom" name="prenom" value="<?= $emp->prenom; ?>"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Sexe</label>
                                                <select id="sexe" name="sexe" class="form-control">
                                                    <option value="homme" <?php if ($emp->sexe == 'homme' || $emp->sexe == 'Homme')
                                                        echo 'selected'; ?>>Homme</option>
                                                    <option value="femme" <?php if ($emp->sexe == 'femme' || $emp->sexe == 'Femme')
                                                        echo 'selected'; ?>>Femme</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Date de naissance</label>
                                                <input type="date" id="date_naiss" name="date_naiss" class="form-control"
                                                    value="<?= $emp->date_nais; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Situation Familliale</label>
                                                <select name="sf" id="sf" class="form-control">
                                                    <option value="celibataire" <?php if ($emp->sf == 'celibataire')
                                                        echo 'selected'; ?>>Célibataire</option>
                                                    <option value="Marié(e)" <?php if ($emp->sf == 'Marié(e)')
                                                        echo 'selected'; ?>>Marié(e)</option>
                                                    <option value="divorce" <?php if ($emp->sf == 'divorce')
                                                        echo 'selected'; ?>>Divorcé(e)</option>
                                                    <option value="veuf" <?php if ($emp->sf == 'veuf')
                                                        echo 'selected'; ?>>Veuf/Veuve</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nombre d'enfants</label>
                                                <input type="number" id="nbr_enft" name="nbr_enft" class="form-control"
                                                    value="<?= $emp->nbr_enft; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Invalidité</label>
                                                <input type="text" id="invalid" name="invalid" class="form-control"
                                                    value="<?= $emp->invalid; ?>">
                                            </div>
                                        </div>

                                        <h4><strong>Status</strong></h4>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option selected>
                                                        <?= $emp->status; ?>
                                                    </option>
                                                    <option value="Mensuel">Mensuel</option>
                                                    <option value="Horaire">Horaire</option>
                                                    <option value="Journalier">Journalier</option>
                                                    <option value="Expatrier">Expatrier</option>
                                                    <option value="Forfait">Forfait</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Position</label>
                                                <select name="position" id="position" class="form-control">
                                                    <option selected>
                                                        <?= $emp->position; ?>
                                                    </option>
                                                    <option value="Actif">Actif</option>
                                                    <option value="Bloqué">Bloqué</option>
                                                    <option value="Retraite">Retraite</option>
                                                    <option value="Congé">Congé</option>
                                                    <option value="Démission">Démission</option>
                                                    <option value="Licenciment">Licenciment</option>
                                                    <option value="Mise_a_pied">Mise a pied</option>
                                                    <option value="Mtation">Mutation</option>
                                                    <option value="Fin_de_contrat">Fin de contrat</option>
                                                    <option value="Abondon_de_poste">Abondon de poste</option>
                                                    <option value="Décé">Décé</option>
                                                    <option value="Invalide">Invalide</option>
                                                    <option value="Suspendu">Suspendu</option>
                                                    <option value="Congé_maladie">Congé maladie</option>
                                                    <option value="Congé_maternité">Congé maternité</option>
                                                    <option value="Congé_special">Congé special</option>
                                                    <option value="Mise_en_disponibilité">Mise en disponibilité</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Structure</label>
                                                <select name="structure" id="structure" class="form-control">
                                                    <option selected>
                                                        <?= $emp->nom_structure; ?>
                                                    </option>
                                                    <option value="Echantillotheque">Echantillotheque</option>
                                                    <option value="Magasin piece rechange">Magasin piece rechange
                                                    </option>
                                                    <option value="Magasin moyens généraux">Magasin moyens généraux
                                                    </option>
                                                    <option value="Magasin reactif/vereries">Magasin reactif/vereries
                                                    </option>
                                                    <option value="Camptine">Camptine</option>
                                                    <option value="Medecine du travail">Medecine du travail</option>
                                                    <option value="Assurance qualité">Assurance qualité</option>
                                                    <option value="Direction site de production">Direction site de
                                                        production</option>
                                                    <option value="Sous-direction de production">Sous-direction de
                                                        production</option>
                                                    <option value="Imprimerie">Imprimerie</option>
                                                    <option value="Hygiene">Hygiene</option>
                                                    <option value="Administration">Administration</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Service</label>
                                                <select name="service" id="service" class="form-control">
                                                    <option selected>
                                                        <?= $emp->nom_service; ?>
                                                    </option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Poste</label>
                                                <select name="poste" id="poste" class="form-control">
                                                    <option selected>
                                                        <?= $emp->poste; ?>
                                                    </option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Qualification</label>
                                                <select name="qualif" id="qualif" class="form-control">
                                                    <option selected>
                                                        <?= $emp->qualif; ?>
                                                    </option>
                                                    <option value="BAC">BAC</option>
                                                    <option value="Licence">Licence</option>
                                                    <option value="Master">Master</option>
                                                    <option value="Doctorat">Doctorat</option>
                                                    <option value="PhD">PhD</option>
                                                    <option value="Technicien_Superieur">Technicien Superieur</option>
                                                    <option value="Ingenieur">Ingenieur</option>
                                                    <option value="Aucun">Aucun</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Grade</label>
                                                <select name="grade" id="grade" class="form-control">
                                                    <option selected>
                                                        <?= $emp->grade; ?>
                                                    </option>
                                                    <option value="Execution">Execution</option>
                                                    <option value="Maitrise">Maitrise</option>
                                                    <option value="Cadre">Cadre</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Categorie</label>
                                                <select name="categorie" id="categorie" class="form-control">
                                                    <option selected>
                                                        <?= $emp->categorie; ?>
                                                    </option>
                                                    <option value="e1">E1</option>
                                                    <option value="e2">E2</option>
                                                    <option value="e3">E3</option>
                                                    <option value="e4">E4</option>
                                                    <option value="e5">E5</option>
                                                    <option value="e6">E6</option>
                                                    <option value="e7">E7</option>
                                                    <option value="m1">M1</option>
                                                    <option value="m2">M2</option>
                                                    <option value="m3">M3</option>
                                                    <option value="m4">M4</option>
                                                    <option value="m5">M5</option>
                                                    <option value="m6">M6</option>
                                                    <option value="m7">M7</option>
                                                    <option value="c1">C1</option>
                                                    <option value="c2">C2</option>
                                                    <option value="c3">C3</option>
                                                    <option value="c4">C4</option>
                                                    <option value="c5">C5</option>
                                                    <option value="c6">C6</option>
                                                    <option value="c7">C7</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label>Date d'entrée</label>
                                                <input type="date" id="date_entre" name="date_entre" value="<?= $emp->date_entre; ?>"
                                                    name="date_entre" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Motif d'entrée</label>
                                                <input type="text" id="motif_entre" name="motif_entre" value="<?= $emp->motif_entre; ?>"
                                                    class="form-control" >
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" name="upd" class="btn btn-info btn-lg btn-block">Valider les modifications</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->


            </div>
            <!-- End of Main Content -->

            <!-- footer -->
            <?php include "views/includes/footer.php"; ?>
            <!-- end of footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pret a quiter l'application ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">Selectionnez "Logout" ci-dessous pour vous decconectez.</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="<?php echo BASE_URL; ?>Logout">Logout</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/script.php'; ?>

</body>

</html>