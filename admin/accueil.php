<?php
session_start();

require_once 'inc/secure.php';

require_once 'inc/dbconnect.php';

include_once 'inc/header.php';

?>
<h3>Bienvenue sur le BackOffice</h3>
<?php echo var_dump($_SESSION); ?>

<?php include_once 'inc/footer.php'; ?>
