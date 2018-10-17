<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    isset($fromController) OR $fromController = array();
    isset($fromController["MESSAGES"]) OR $fromController["MESSAGES"] = array();
?>

<div id="chat" class="border bg-secondary d-flex flex-column-reverse">
	<form id="chatInput" class="d-flex">
		<input type="text" id="inputMessage" placeholder="Your message...">
		<input type="submit" value="Send">
	</form>
	<div id="chatMessages" class="d-flex flex-column-reverse align-items-start">
		
		<?php 
		  foreach($fromController["MESSAGES"] as $message){
               $tpl = new Smarty;
               $tpl->template_dir = APPPATH."views\\templates\\";
               $tpl->compile_dir = APPPATH."views\\templates_c\\";
               
               foreach($message as $key => $var){
                   $tpl->assign($key, $var);
               }
               $tpl->display("chatMessage.tpl");
           }
    	?>
	</div>
	<script>
		fromController = {
			"sendAjaxMessageUrl": "<?php echo base_url("index.php/chat/sendMessage");?>",
			"getMessagesUrl": "<?php echo base_url("index.php/chat/ajaxGetMessages");?>"
		};
	</script>
</div>

