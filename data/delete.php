<?php
session_start();
if ($_POST["submit"] !== NULL && $_POST["submit"] === "Vous êtes sûr?")
{
    $fd = fopen("../private/passwd", "c+");
    flock($fd, LOCK_SH | LOCK_EX);
    $file = file_get_contents("../private/passwd");
    $file = unserialize($file);
    foreach($file as $key => $usr)
    {
        if($usr['login'] === $_POST['login'])
        {
            if ($usr['passwd'] === hash("whirlpool", $_POST['passwd']) && $usr['passwd'] === hash("whirlpool", $_POST['passwd2']))
            {
                unset($file[$key]);
                $ERASED = "User Erased";
                $final = serialize($file);
                file_put_contents("../private/passwd", $final . "\n");
                break;
            }
            $ERASED = "Wrong password";
        }
    }
    flock($fd, LOCK_UN);
    if ($ERASED === "User Erased")
    {
        session_unset();
        session_destroy();
        header("Location: login.php?error=User Erased");
    }
    else if ($ERASED === "Wrong password")
    {
        header("Location: delete.php?error=Wrong password");
    }
    else
    {
        header("Location: delete.php?error=User unknown");

    }
}

?>
<html>
    <body>
        <form method="post" action="delete.php">
            Identifiant: <br />
            <input type="text" name="login" required><br />
            Mot de passe: <br />
            <input type="password" name="passwd" required><br />
            Répéter le mot de passe: <br />
            <input type="password" name="passwd2" required><br />
            <input type="submit" name="submit" value="Vous êtes sûr?"/><br />
            <a href='profile.php'>Profile</a><br />
            <p><?php echo $_GET['error']; ?></p><br />
        </form>
    </body>
</html>