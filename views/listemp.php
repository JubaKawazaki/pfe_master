<?php
if (isset($_POST['find'])) {
    $date = new AdminsController();
    $employe = $date->findEmployeADM();
} else {
    $date = new AdminsController();
    $employe = $date->getAllusers();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include 'includes/header.php';
    ?>

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

                    if ($type === 'user') {
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

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="edit.html">
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
                        <h1 class="h3 mb-0 text-gray-800">Personal Workspace</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Position</th>
                                            <th>Poste</th>
                                            <th>Service</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($employe as $emp): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $emp['mat']; ?>
                                                </td>
                                                <td>
                                                    <?= $emp['nom']; ?>
                                                </td>
                                                <td>
                                                    <?= $emp['prenom']; ?>
                                                </td>
                                                <td>
                                                    <?= $emp['position']; ?>
                                                </td>
                                                <td>
                                                    <?= $emp['poste']; ?>
                                                </td>
                                                <td>
                                                    <?= $emp['nom_service']; ?>
                                                </td>
                                                <td class="d-flex flex-row">

                                                    <form method="post" action="update" class="mr-2">
                                                        <input type="hidden" name="id_service"
                                                            value="<?= $emp['id_service']; ?>">
                                                        <input type="hidden" name="mat" value="<?php echo $emp['mat']; ?>">
                                                        <button class="btn btn-sm btn-success" name="update">
                                                            <i class="fa fa-edit"></i>
                                                            Mettre a jour
                                                        </button>
                                                    </form>

                                                    <form method="post" action="delete" class="mr-2">
                                                        <input type="hidden" name="mat" value="<?= $emp['mat']; ?>">
                                                        <input type="hidden" name="type" value="<?= $emp['type']; ?>">
                                                        <button class="btn btn-sm btn-danger" name="delete">
                                                            <i class="fa-solid fa-box-archive"></i>
                                                            Archiver
                                                        </button>
                                                    </form>
                                                    <form method="post" action="#" class="mr-2">
                                                        <input type="hidden" name="mat" value="<?php echo $emp['mat']; ?>">
                                                        <input type="hidden" name="sx" value="<?php echo $emp['sexe']; ?>">
                                                        <a class="btn btn-sm btn-info" name="details" data-toggle="modal"
                                                            data-target="#detailsModal">
                                                            <i class="fa fa-info"></i>
                                                            Details
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['details'])) {
        $date = new EmployesController();
        $employe = $date->getOneEmploye();
    }
    $sx = $_POST['sx'];
    ?>

    <!-- details Modal-->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal">Information de l'employer</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="container py-5">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                            <img src="assets/img/avatar_mono.svg" alt="avatar"
                                                class="rounded-circle img-fluid" style="width: 175px;">
                                        <h5 class="my-3"></h5>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Matricule</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->mat; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Nom Prenom</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->nom . ' ' . $employe->prenom; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">example@example.com</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Telephone</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(097) 234-5678</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mobile</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(098) 765-4321</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-around">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div>
                                        <br>
                                        <center>
                                            <h4>Identification</h4>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Sexe</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->sexe; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Date naissance</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->date_nais; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">SSN</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->ssn; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Situation familaile</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->sf; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Nombre d'enfants</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->nbr_enft; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Invalidité</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->invalid; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div>
                                        <br>
                                        <center>
                                            <h4>Status</h4>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Status</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->status; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Position</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->position; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Structure</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->section; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Service</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->id_service; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Poste</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->poste; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Grade</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->grade; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Qualification</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->qualif; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Categorie</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->categorie; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Date d'entrée</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->date_entre; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0">Motif d'entrée</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0">
                                                    <?= $employe->motif_entre; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'includes/script.php';
    ?>
</body>

</html>