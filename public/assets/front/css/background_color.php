<?php
    header("Content-type: text/css; charset: UTF-8");
    if(isset($_GET['background_color']))
    {
    $background_color = '#'.$_GET['background_color'];
    }
    else {
    $background_color = '#f2f2f2';
    }
?>

body{
    background : <?php echo $background_color?>  !important;
}
