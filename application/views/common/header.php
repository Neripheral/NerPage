<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    $fromController = $fromController ?: array();
    $fromController["css"] = $fromController["css"] ?: array();
    $fromController["js"] = $fromController["js"] ?: array();
?>


<head>
    <title>NerPage</title>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url("css");?>/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css">
    <?php
    if(isset($fromController) and isset($fromController["css"]))
        foreach($fromController["css"] as $path){
            echo "<link rel='stylesheet' href='";
            echo $path;
            echo "'>";
    }
    ?>
  	
  	<!-- JS -->	
  	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script type="application/javascript" src="https://unpkg.com/react@16.0.0/umd/react.production.min.js"></script>
 	<script type="application/javascript" src="https://unpkg.com/react-dom@16.0.0/umd/react-dom.production.min.js"></script>
  	<script type="application/javascript" src="https://unpkg.com/babel-standalone@6.26.0/babel.js"></script>
  	<script>var base_url = '<?php echo base_url("js/");?>'</script>
  	<?php 
      	if(isset($fromController) and isset($fromController["js"]))
      	     foreach($fromController["js"] as $path){
      	         echo "<script type='text/babel' src='";
      	         echo $path;
      	         echo "'></script>";
      	     }
  	?>
</head>