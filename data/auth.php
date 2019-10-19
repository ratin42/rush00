<?php
function auth($login, $passwd)
{
    $fd = fopen("../private/passwd", "c+");
    flock($fd, LOCK_SH | LOCK_EX);
    $file = file_get_contents("../private/passwd");
    $file = unserialize($file);
    flock($fd, LOCK_UN);
    foreach($file as $usr)
        if($usr['login'] === $login)
        {
            if ($usr['passwd'] === hash("whirlpool",$passwd))
            {
                if($usr['admin'])
                    return('admin');
                return('connected');
            }
            return('known');
        }
    return('unknown');
}
?>