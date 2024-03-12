<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Titre</th>
                        <th>Lien</th>
                        <th>Date creation</th>
                        <th>Dernier Accées</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employe as $emp): ?>
                        <tr>
                            <td>
                                <?php echo $emp['id_doc']; ?>
                            </td>
                            <td>
                                <?= pathinfo($emp['nom_doc'], PATHINFO_FILENAME); ?>
                            </td>
                            <td>
                                <a href="<?php echo $emp['lien_acd']; ?>" target="_blank" ?>
                                    <?= $emp['nom_doc']; ?>
                                </a>
                            </td>
                            <td>
                                <?= $emp['date_creation']; ?>
                            </td>
                            <td>
                                <?= $emp['last_accessed']; ?>
                            </td>
                            <td class="d-flex flex-row">

                                <form method="post" action="envoie" class="mr-2">
                                    <input type="hidden" name="id_doc" value="<?php echo $emp['id_doc']; ?>">
                                    <button class="btn btn-sm btn-success" name="recherch_emp">
                                        <i class="fa-solid fa-share-from-square"></i></i>
                                        Envoyer
                                    </button>
                                </form>

                                <form method="post" action="Archive" class="mr-2">
                                    <input type="hidden" name="id" value="<?php echo $emp['id_doc']; ?>">
                                    <button class="btn btn-sm btn-danger" name="archiver">
                                        <i class="fa-solid fa-box-archive"></i>
                                        Archiver
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>