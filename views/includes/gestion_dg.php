<!-- Heading -->
<div class="sidebar-heading">
                Gestion
            </div>

            <!-- Nav Item - gestion Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Employée</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chef de service:</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>addchef">Ajouter Chef de service</a>
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>listchef">Liste des Chefs de services</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Employées:</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>addemp">Ajouter Employée</a>
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>listemp">Liste des employées</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesTwo"
                    aria-expanded="true" aria-controls="collapsePagesTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Structure</span>
                </a>
                <div id="collapsePagesTwo" class="collapse" aria-labelledby="headingPagesTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>addchef">Ajouter un service</a>
                        <a class="collapse-item" href="<?php echo BASE_URL; ?>listchef">Liste un departement</a>
                    </div>
                </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">