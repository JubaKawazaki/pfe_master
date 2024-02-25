
<?php
if (isset($_POST['cnx'])) {
    $data = new UserController();
    $employe = $data->cnx();
    var_dump($employe);
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/login.css" rel="stylesheet">

  <title>Page d'authentification</title>
  <link rel="icon" type="image/x-icon" href="assets/img/icon.png">

</head>

<body>
  <section class="form-02-main">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="_lk_de">
            <div class="form-03-main">
              <div class="logo">
                <img src="assets/img/logo_saidal.png">
              </div>
              <form method="POST">
                <div class="form-group">
                  <input type="number" name="id" class="form-control _ge_de_ol" type="text"
                    placeholder="Entrez votre ID" required="" aria-required="true">
                </div>
                <div class="form-group">
                  <input type="number" name="Matricule" class="form-control _ge_de_ol" type="text"
                    placeholder="Entrez votre Matricule" required="" aria-required="true">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control _ge_de_ol" type="text"
                    placeholder="Entrez votre mot de passe" required="" aria-required="true">
                </div>
                <div class="form-group">
                  <div class="_btn_04" style="background-color:darkturquoise" >
                    <button class="btn" name="cnx"><strong>Connexion</strong></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>