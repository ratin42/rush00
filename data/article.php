<?php
//DECOMENTER POUR LE RENDU
/* header('Cache-Control: no cache');
session_cache_limiter('private_no_expire');  */
session_start();
function get_all_categories($article)
{
	$result = [];
	foreach($article as $element)
	{
		foreach($element['categorie'] as $cate)
		{
			if (in_array($cate, $result) == false)
				array_push($result, $cate);
		}
	}
	return $result;
}

function print_article($article, $i)
{
	echo '<div class="product">';
	$path = "../image/" . $article[$i]['img'];
	if (file_exists($path))
	{
		echo '<a target="_parent" href="product.php?id=' . $i . ' "><img height="250px"
			whidth="250px" src="../image/' . $article[$i]['img'] . 
			'" alt="' . $article[$i]['name'] . '"></a>';
	}
	else
	{
		echo '<a target="_parent" href="product.php?id=' . $i . ' "><img height="250px"
			whidth="250px" src="../image/no-photo.jpg' . '" alt="' . $article[$i]['name'] . '"></a>';
	}
	echo '<a target="_parent" href="product.php?id=' . $i . ' ">' . $article[$i]['name'] . '</a>';
	echo '</div>';
}

if (file_exists("../private/article") == false)
{
	echo "ERROR\n";
	exit ;
}
$fp = fopen("../private/article", "r+");
flock($fp, LOCK_EX | LOCK_SH);
$article = file_get_contents("../private/article");
flock($fp, LOCK_UN);
fclose($fp);
$article = unserialize($article);
$categories = get_all_categories($article);
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<form action="article.php" method="POST">
			<select name="categories">
				<option value="">All</option>
				<?php
					foreach($categories as $cat)
						echo '<option value="' . $cat .'">' . $cat .'</option>';
				?>
			</select>
			<input type="submit" value="OK">
		</form>
		<?php
		if (isset($_POST['categories']) == false || $_POST['categories'] === "")
		{
			for ($i = 0; $i < count($article); $i++)
					print_article($article, $i);
		}
		else
		{
			for ($i = 0; $i < count($article); $i++)
			{
				if (in_array($_POST['categories'], $article[$i]['categorie']) == true)
					print_article($article, $i);
			}
		}
		?>
	</body>
</html>