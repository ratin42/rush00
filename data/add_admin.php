<?php
if ($_POST["submit"] === "OK" && auth($_POST['login'], $_POST['passwd']) === 'admin')
{
    $FOUND = FALSE;
    $fd = fopen("../private/passwd", "c+");
    flock($fd, LOCK_SH | LOCK_EX);
    $file = file_get_contents("../private/passwd");
    $file = unserialize($file);
    foreach($file as $key => $elem)
    {
        if($elem['login'] === $_POST['user'])
        {    
            $file[$key]['admin'] = TRUE;
            $FOUND = TRUE;
        }
    }
    flock($fd, LOCK_UN);
    if($FOUND)
        header('Location: add_admin.php?error="Administrator added"');
    else
    {
        header('Location: add_admin.php?error="User doesn\'t exist"');
    }
}

?>
<html><body>
    <form method="post" action="add_admin.php">
        Identifiant administrateur: <br />
        <input type="text" name="login" required><br />
        Mot de passe:<br />
        <input type="password" name="passwd" required><br />
        Utilisateur à passer administrateur: <br />
        <input type="text" name="user" required><br />
        <input type="submit" name="submit" value="OK"/><br />
        <a href='profile.php'>Profile</a><br />
        <p><?php echo $_GET['error']; ?></p>
    </form>
</body></html>