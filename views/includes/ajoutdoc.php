<?php
if (isset($_POST['ajouter'])) {
    $doc = new DocumentController();
    $doc::addDocument();
}

?>

<!-- document add trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#ajoutdocModal" style="margin-bottom: 5px;">
    <i class="fa fa-plus" style="margin-right: 5px;"></i>
    Ajouter Document
</button>

<!-- Ajout document Modal-->
<div class="modal fade" id="ajoutdocModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times; x</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fileInput">Choisir votre fichier</label>
                        <input type="file" class="form-control-file" id="fileInput" name="dff"
                            accept=".pdf, .doc, .docx, .ppt, .pptx, .xlsx, .xls, .xlsms" lang="fr">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>