<?php 
    defined("BASEPATH") OR exit("No direct script access allowed"); 
    
    $fromController = @$fromController ?: array();
    $fromController["id"] = @$fromController["id"] ?: "id_not_specified";
    $fromController["content"] = @$fromController["content"] ?: "Error: content key doesn't exist!";
?>


<main id='<?php echo $fromController["id"]; ?>' class='d-flex'>
	<?php echo $fromController["content"]; ?>
</main>