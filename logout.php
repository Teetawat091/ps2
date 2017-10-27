<?
session_start();

// Unset all of the session variables.
$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

session_destroy();

?>
<meta http-equiv="refresh" content="0;url='index.php'">