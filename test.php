<?php
include 'includes/travel-config.php';
$db = new CitiesGateway($connection);
$result = $db->findParam(array('AsciiName','Population'));
foreach($result as $row){
    echo $row['AsciiName'];
    echo $row['Population'];
    echo '<br>';
}
?>