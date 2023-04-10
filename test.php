<?php
session_start();
echo "<pre>";
echo "<h3>variable $ GLOBAL</h3>";
print_r($GLOBALS);
echo "<h3>variable $ _SERVER</h3>";
print_r($_SERVER);

echo  password_hash(trim(htmlspecialchars("123123")),PASSWORD_DEFAULT,['cost'=> 10])."\n";
echo  password_hash(trim(htmlspecialchars("123123")),PASSWORD_DEFAULT,['cost'=> 10])."\n";
echo "</pre>";

?>

