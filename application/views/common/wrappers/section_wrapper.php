<?php
defined("BASEPATH") OR exit("No direct script access allowed");

$fromController = @$fromController ?: array();
$fromController["content"] = @$fromController["content"] ?: "Error: content key doesn't exist!";
$fromController["id"] = @$fromController["id"] ?: "section_undefined";
?>

<section id='<?php echo $fromController["id"]; ?>'>
	<?php echo $fromController["content"]; ?>
</section>
