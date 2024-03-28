<?php

$type = $_SESSION['type'];

$date = new DocumentController();
$demande = $date->getDemandeCreate();


?>





<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id demande</th>
                        <th>Reference</th>
                        <th>Type</th>
                        <th>Etat</th>
                        <th>Lien</th>
                        <th>Date d'envoie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demande as $dmnd): ?>
                        <tr>
                            <td>
                                <?php echo $dmnd['id_dmnd']; ?>
                            </td>
                            <td>
                                <?php echo $dmnd['reference']; ?>
                            </td>
                            <td>
                                <?php echo $dmnd['type']; ?>
                            </td>
                            <td>
                                <?php echo $dmnd['state']; ?>
                            </td>
                            <td>
                                <a href="<?php echo $dmnd['lien']; ?>" target="_blank" ?>
                                    <?= $dmnd['reference']; ?>
                                </a>
                            </td>
                            <td>
                                <?= $dmnd['date_creation']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>