<?php
session_start();
if ($_POST["submit"] === "OK" && $_SESSION["loggued_as_admin"])
{
    $fd = fopen("../private/article", "c+");
    flock($fd, LOCK_SH | LOCK_EX);
    $file = file_get_contents("../private/article");
    $file = unserialize($file);
    $new_product = array(array(
        'name'		=> $_POST['name'],
					'price'		=> $_POST['price'],
					'categorie'	=> explode("/", $_POST['categorie']),
					'img'		=> $_POST["img"],
					'info'		=> $_POST["info"]
    ));
    $file = array_merge($file, $new_product);
    $final = serialize($file);
    file_put_contents("../private/article", $final . "\n");
    flock($fd, LOCK_UN);
    header('Location: add_admin.php?error="categories added"');
}
else if(isset($_POST['name']) || isset($_POST['price']) || isset($_POST['categorie']) || isset($_POST['img']) || isset($_POST['info']))
{
    header('Location: add_product.php?error="Something went wrong..."');
}
?>
<html><body>
    <form method="post" action="add_product.php">
        Name: <br />
        <input type="text" name="name" required><br />
        Price: <br />
        <input type="text" name="price" required><br />
        Categorie: <br />
        <input type="text" name="categorie" required><br />
        Image: <br />
        <input type="text" name="img" required><br />
        Informations: <br />
        <input type="text" name="info" required><br />

        <input type="submit" name="submit" value="OK"/><br />
        
        <a href='profile.php'>Retour</a><br />
        
        <p><?php echo $_GET['error']; ?></p>
    </form>
</body></html>