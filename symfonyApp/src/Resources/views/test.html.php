<?php $view->extend('layout.html.php'); ?>

This is the test page / view

<?php
for($i = 0; $i < count($data); $i++)
{
    echo "<p>" . $data[$i] . '</p>';
}
?>

