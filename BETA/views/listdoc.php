<?php

$type = $_SESSION['type'];

if (isset($_POST['find'])) {
    $date = new DocumentController();
    $employe = $date->findDoc();
} else {
    $date = new DocumentController();
    $employe = $date->getDocumentsCreate();
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_dg.html">
                <div class="logo-image-small">
                    <img src="assets/img/icon.png" width="60">
                </div>
                <div class="sidebar-brand-text mx-3">Saidal</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard_dg.html">
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
                        <a class="collapse-item" href="personel_dg.html">Documents Personel</a>
                        <a class="collapse-item" href="shared_dg.html">Documents Recus</a>
                        <a class="collapse-item" href="archive_dg.html">Documents Archivés</a>
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
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Demandes Recus</a>
                        <a class="collapse-item" href="#">Demandes Validés</a>
                        <a class="collapse-item" href="#">Demande Refusés</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php
            $type = $_SESSION['type'];
            
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Afficher nom prenom </span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile_dg.html">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
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
                        <div>
                            <button class="btn btn-info" style="margin-bottom: 5px;">Ajouter Fichier</button>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <link rel="stylesheet" href="assets/css/share_table.css">
                    <div class="container-fluid">
                        <div class="row" style="width: 105%;margin-left: 4%;">
                            <div class="col-md-offset-1 col-md-10">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="mytable" class="table table-bordred table-striped">
                                                    <div class=" text-right">
                                                            <input type="text" class="form-control" placeholder="Search">
                                                    </div>
                                                    <div>
                                                        <div class="btn_group">
                                                            <button class="btn btn-default" title="Pdf"><i
                                                                    class="fa fa-file-pdf"></i></button>
                                                            <button class="btn btn-default" title="Word"><i
                                                                    class="fas fa-file-word"></i></button>
                                                            <button class="btn btn-default" title="Excel"><i
                                                                    class="fas fa-file-excel"></i></button>
                                                            <button class="btn btn-default" title="PowerPoint"><i
                                                                    class="fas fa-file-powerpoint"></i></button>
                                                        </div>
                                                    </div>
                                                    <thead>
                                                        <th><input type="checkbox" id="checkall" /></th>
                                                        <th>Ref Document</th>
                                                        <th>Nom Document</th>
                                                        <th>Extension</th>
                                                        <th>Type</th>
                                                        <th>Date d'ajout</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="checkbox" class="checkthis" /></td>
                                                            <td>Mohsin</td>
                                                            <td>Irshad</td>
                                                            <td>CB 106/107 Street # 11</td>
                                                            <td>isometric.mohsin@gmail.com</td>
                                                            <td>+923335586757</td>
                                                            <td>
                                                                <button class="btn btn-warning btn-xs">
                                                                    <span><i class="fa fa-edit"></i></span></button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-xs">
                                                                    <span><i class="fa fa-trash"></i></span></button>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><input type="checkbox" class="checkthis" /></td>
                                                            <td>Mohsin</td>
                                                            <td>Irshad</td>
                                                            <td>CB 106/107 Street # 11</td>
                                                            <td>isometric.mohsin@gmail.com</td>
                                                            <td>+923335586757</td>
                                                            <td>
                                                                <button class="btn btn-warning btn-xs">
                                                                    <span><i class="fa fa-edit"></i></span></button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-xs">
                                                                    <span><i class="fa fa-trash"></i></span></button>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td><input type="checkbox" class="checkthis" /></td>
                                                            <td>Mohsin</td>
                                                            <td>Irshad</td>
                                                            <td>CB 106/107 Street # 11</td>
                                                            <td>isometric.mohsin@gmail.com</td>
                                                            <td>+923335586757</td>
                                                            <td>
                                                                <button class="btn btn-warning btn-xs">
                                                                    <span><i class="fa fa-edit"></i></span></button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-xs">
                                                                    <span><i class="fa fa-trash"></i></span></button>
                                                            </td>
                                                        </tr>



                                                        <tr>
                                                            <td><input type="checkbox" class="checkthis" /></td>
                                                            <td>Mohsin</td>
                                                            <td>Irshad</td>
                                                            <td>CB 106/107 Street # 11</td>
                                                            <td>isometric.mohsin@gmail.com</td>
                                                            <td>+923335586757</td>
                                                            <td>
                                                                <button class="btn btn-warning btn-xs">
                                                                    <span><i class="fa fa-edit"></i></span></button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-xs">
                                                                    <span><i class="fa fa-trash"></i></span></button>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td><input type="checkbox" class="checkthis" /></td>
                                                            <td>Mohsin</td>
                                                            <td>Irshad</td>
                                                            <td>CB 106/107 Street # 11</td>
                                                            <td>isometric.mohsin@gmail.com</td>
                                                            <td>+923335586757</td>
                                                            <td>
                                                                <button class="btn btn-warning btn-xs">
                                                                    <span><i class="fa fa-edit"></i></span></button>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger btn-xs">
                                                                    <span><i class="fa fa-trash"></i></span></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="clearfix"></div>
                                                <ul class="pagination pull-left" style="background-color: aquamarine;">
                                                    <li class="disabled"><a href="#"><span
                                                                class="glyphicon glyphicon-chevron-left"></span></a>
                                                    </li>
                                                    <li class="active"><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">5</a></li>
                                                    <li><a href="#"><span
                                                                class="glyphicon glyphicon-chevron-right"></span></a>
                                                    </li>
                                                </ul>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"><span class="glyphicon glyphicon-remove"
                                                        aria-hidden="true"></span></button>
                                                <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input class="form-control " type="text" placeholder="Mohsin">
                                                </div>
                                                <div class="form-group">

                                                    <input class="form-control " type="text" placeholder="Irshad">
                                                </div>
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control"
                                                        placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-warning btn-lg"
                                                    style="width: 100%;"><span
                                                        class="glyphicon glyphicon-ok-sign"></span>Update</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        $("#mytable #checkall").click(function () {
                                            if ($("#mytable #checkall").is(':checked')) {
                                                $("#mytable input[type=checkbox]").each(function () {
                                                    $(this).prop("checked", true);
                                                });

                                            } else {
                                                $("#mytable input[type=checkbox]").each(function () {
                                                    $(this).prop("checked", false);
                                                });
                                            }
                                        });

                                        $("[data-toggle=tooltip]").tooltip();
                                    });
                                </script>

                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true"><span class="glyphicon glyphicon-remove"
                                                        aria-hidden="true"></span></button>
                                                <h4 class="modal-title custom_align">Delete this entry</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="alert alert-danger"><span
                                                        class="glyphicon glyphicon-warning-sign"></span> Are you sure
                                                    you want to delete this Record?</div>

                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-success"><span
                                                        class="glyphicon glyphicon-ok-sign"></span>Yes</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                                        class="glyphicon glyphicon-remove"></span>No</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
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
include 'includes/script.php';
?>
</body>

</html>