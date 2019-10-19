<?php
function error()
{
    header('Location: login.php?error=Username already taken.');
    exit(); 
}

function search($file, $login)
{
    $i = 0;
    while ($file[$i])
    {
        foreach ($file[$i] as $key => $value)
        {
            if ($key == "login" && $value == $login)
                error();
        }
        $i++;
    }
}
if($_POST["submit"] != NULL && $_POST["submit"] == "OK")
{
    if (!($_POST['login'] == NULL || $_POST['passwd'] == NULL ))
    {
        $newuser = array(array(
            'login'=>$_POST['login'],
            'passwd'=>hash("whirlpool",$_POST['passwd']),
            'admin' => FALSE
        ));
        $fd = fopen("../private/passwd", "c+");
        flock($fd, LOCK_SH | LOCK_EX);
        $file = file_get_contents("../private/passwd");
        $file = unserialize($file);
        search($file, $_POST['login']);
        $final = array_merge($file, $newuser);
        $final = serialize($final);
        file_put_contents("../private/passwd", $final . "\n");
        flock($fd, LOCK_UN);
        header('Location: login.php');
    }
    else
        error();
}
else
    error();
?>
