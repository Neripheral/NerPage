<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    $fromController = @$fromController ?: array();
    $fromController["content"] = @$fromController["content"] ?: "Error: content key doesn't exist!";
?>

<body>
	<div id="root">
		<?php echo $fromController["content"]; ?>
	</div>
</body>