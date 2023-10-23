<?php
session_start();
if (isset($_SESSION["contador"])) {
    $_SESSION["contador"] = $_SESSION["contador"] + 1;
} else {
    $_SESSION["contador"] = 0;
}
echo $_SESSION["contador"];

?>
<form method="post" action="#">
    <button type="submit">+1</button>
</form>