<?php
$bdd = new PDO('mysql:host=localhost;dbname=saidal;charset=utf8;', 'root', '');
if(isset($_GET['send'])){
    $name = $_GET['name'];
    $msg = $_GET['msg'];
    $insertmsg = $bdd->prepare('INSERT INTO chat(name, msg) VALUES(?, ?)');
    $insertmsg->execute(array($name, $msg));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'views/includes/header.php';
    ?>
</head>

<body>
<form method="POST">
    <input type="text" name="name">
    <br><br>
    <textarea name="msg"></textarea>
    <br><br>
    <input type="submit" name="send">
</form>
</body>

<footer>
<?php
    include 'views/includes/footer.php';
    ?>
</footer>
</html>
