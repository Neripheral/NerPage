<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="chat" class="border bg-secondary d-flex flex-column-reverse">
	<div id="chatMessages">
	</div>
	<form id="chatInput" class="d-flex">
		<input type="text" id="inputMessage" placeholder="Your message...">
		<input type="submit" value="Send">
	</form>
	<script>
		phpData = {
			"sendingUrl": "<?php echo base_url("index.php/chat/sendMessage");?>"
		};
	</script>
</div>