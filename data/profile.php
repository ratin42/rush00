<?php
session_start();
if ($_SESSION['loggued_on_user'] === '')
	header("Location: login.php");
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <h1>Profile</h1>
        <h2>Welcome <?php echo $_SESSION["loggued_on_user"]; ?></h2>
    </head>
    <body>
        <div class="footer">
            <a href="modif.html">Change password</a>
            <br />
            <a href="logout.php">Logout</a>
            <br />
            <a href="delete.php">Delete User</a>
            <br />
            <?php if($_SESSION['loggued_as_admin']):?>
                <a href='add_admin.php'>Add an admin</a><br />
                <a href='create.html'>Add a user</a><br />
                <a href='add_product.php'>Add a product</a><br />
            <?php endif; ?>
            <br />
            <a href='profile.php'>Profile</a><br />
			<a href='panier.php'>Panier</a><br />
			<?php
				print_r($_SESSION['panier']);
			?>
            <p><?php echo $_GET['error']; ?></p><br />
        </div>
    </body>
</html>