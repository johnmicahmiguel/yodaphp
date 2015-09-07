<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->page_title; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    
    <?php
    if(isset($this->css)){
        foreach($this->css as $css){
            echo '<link type="text/css" rel = "stylesheet" href = "'.URL.'views/'.$css.'" />';
        }
    }
    ?>

</head>

<body id ="<?php echo ($this->body != "") ? $this->body : ""; ?>">
    