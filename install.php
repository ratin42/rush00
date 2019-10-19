#!/usr/bin/php
<?php
if(!file_exists("private"))
    mkdir("private");
if(!file_exists("private/passwd"))
{
    $root = array(array(
        'login'=>'admin',
        'passwd'=>hash("whirlpool", 'password'),
        'admin'=> TRUE)
    );
    $init = serialize($root);
	file_put_contents("private/passwd", $init);
$article = array(
				array(
					'name'		=> "Playstation 4",
					'price'		=> "399$",
					'categorie'	=> array('jeux_video', 'console'),
					'img'		=> "ps4.jpeg",
					'info'		=> "Sony PlayStation 4 Pro 1TB.<br> Plateforme: 
									PlayStation 4 Pro.<br> Couleur du produit: 
									Noir.<br> Mémoire interne: 8196 Mo.<br> Supports de 
									stockage: Disque dur.<br> Capacité de stockage 
									interne: 1000 Go.<br> Lecteur optique: 
									Blu-Ray/DVD.<br> LAN Ethernet : taux de transfert 
									des données: 10,100,1000 Mbit/s.<br> Standards wifi: 
									IEEE 802.11a,IEEE 802.11ac,IEEE 802.11b,IEEE 802.11g,IEEE 802.11n<br>
									Modèle du Bluetooth: 4.0 LE.<br> Consommation électrique typique: 310 W, 
									Tension d'entrée AC: 100 - 240 V.<br> Fréquence d'entrée AC: 50 - 60 Hz.<br>
									Poids: 3,3 kg, Largeur: 295 mm, Profondeur: 327 mm",
				),
				array(
					'name'		=> "velo",
					'price'		=> "499$",
					'categorie'	=> array('jouet', 'sport'),
					'img'		=> "velo.jpg",
					'info'		=> "Progressez avec un vélo polyvalent! Sa géométrie confort, son cadre en aluminium,
									 ses 2X8 vitesses et sa fourche carbone vous permettront de vous frotter à tous 
									 les types de parcours"
				),
				array(
					'name'		=> "Super Sparrow Bouteille d'eau en Acier",
					'price'		=> "15$",
					'categorie'	=> array('voyage', 'design'),
					'img'		=> "sparrow.jpg",
					'info'		=> "CONCEPTION DE QUALITÉ SUPÉRIEURE - La bouche 
									standard est idéale pour siroter et tout en restant accommodant des 
									glaçons. De plus, la sécurité est de la plus haute importance, car 
									les bouteilles sont fabriquées en plastique non toxique sans BPA et 
									en acier inoxydable 18/8 de qualité alimentaire.",
				),
				array(
					'name'		=> "COUNT 360° HD",
					'price'		=> "139$",
					'categorie'	=> array('sport', 'style'),
					'img'		=> "ski.jpg",
					'info'		=> "Masque de ski All-Moutain de haute qualité avec monture 
									ultra-fine Live Fit, Doté de la technologie HD et FDL, Pour toutes les 
									conditions de luminosité (VLT : 8-42 %), Protection 100 % UVA/UVB",
				),
				array(
					'name'		=> "Kindle Paperwhite ",
					'price'		=> "109$",
					'categorie'	=> array('technologie'),
					'img'		=> "kindle.jpg",
					'info'		=> "Notre Kindle Paperwhite le plus fin et le 
									plus léger à ce jour : écran de 300 ppp sans reflets, se lit comme 
									une véritable page papier, même en plein soleil.",
				),
			);
$article = serialize($article);
if (file_exists("private") == false)
	mkdir("private", 0755);	
$fp = fopen("private/article", "w+");
flock($fp, LOCK_EX | LOCK_SH);
file_put_contents("private/article", $article);
flock($fp, LOCK_UN);
fclose($fp);
echo 'OK' . PHP_EOL;
}
?>