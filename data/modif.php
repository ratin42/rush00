<?php
function error()
{
    header('Location: login.php?error=Wrong password or username');
    exit();    
}

function ok()
{
    echo "OK\n";
    header('Location: login.php?error=Password changed.');
    exit();    
}

if ($_POST["submit"] !== NULL && $_POST["submit"] === "OK" && $_POST['login'] !== "" && $_POST['oldpw'] !== "" && $_POST['newpw'] !== "")
{
    $CHANGED = FALSE;
    $fd = fopen("../private/passwd", "c+");
        flock($fd, LOCK_SH | LOCK_EX);
    $file = file_get_contents("../private/passwd");
    $file = unserialize($file);
    $i = 0;
    foreach($file as $usr)
    {
        if($usr['login'] === $_POST['login'] && $usr['passwd'] === hash("whirlpool", $_POST['oldpw']))
        {
            $file[$i]['passwd'] = hash("whirlpool", $_POST['newpw']);
            $CHANGED = TRUE;
            $final = serialize($file);
            file_put_contents("../private/passwd", $final . "\n");
            break;
        }
        $i++;
    }
    if($fd)
        flock($fd, LOCK_UN);
    if ($CHANGED)
        ok();
    else
        error();
}
else
{
    error();
}

?>