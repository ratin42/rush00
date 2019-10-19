<?php
session_start();
include("auth.php");
if ($_SESSION['loggued_on_user'] != "")
    header('Location: profile.php'); 
else
{
	if ((auth($_POST['login'], $_POST['passwd']) === 'connected'|| auth($_POST['login'], $_POST['passwd']) === 'admin') && $_POST['submit'] === 'Login')
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		if (auth($_POST['login'], $_POST['passwd']) === 'admin')
			$_SESSION['loggued_as_admin'] = TRUE;
		else
			$_SESSION['loggued_as_admin'] = FALSE;
		header('Location: profile.php'); 
	}
	else if((auth($_POST['login'], $_POST['passwd']) === 'known') && $_POST['submit'] === 'Login')
		header('Location: login.php?error=Wrong password.');
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form method='post' action='login.php'>
            Identifiant:<br />
            <input type='text' name='login' required><br />
            Mot de passe:<br />
            <input type='password' name='passwd' required><br />
            <input type='submit' name='submit' value='Login'/><br />
        </form>
        <a href='modif.html'>Change password?</a><br />
        <a href='create.html'>New User?</a><br />
        <p><?php echo($_GET['error']); ?></p>
    </body>
</html>