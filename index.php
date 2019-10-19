<?php
session_start();
if (isset($_POST) == true)
{
	$panier = ['id' =>$_POST['id'], 'quantity' => $_POST['quantity']];
	array_push($_SESSION['panier'], $panier);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="bandeau">
           <a href="index.php" class="logo"><h1>FT MINISHOP</h1></a>
        </div>
        <div class="bdy">
            <iframe class="content" name='article' src='data/article.php' width='85%' height='100%'></iframe>
			<iframe class="profile" name="logguer" src="data/login.php" width="15%" height="100%" ></iframe>
        </div>
    </body>    
</html>