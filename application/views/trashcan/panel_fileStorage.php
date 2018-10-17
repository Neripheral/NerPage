<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($fromController) OR $fromController = array();
isset($fromController['DATA']) OR $fromController['DATA'] = array();
?>
<div id="panel_fileStorage" class="border d-flex flex-column h-100">
	<div id="files-add" class="w-100 h-25 bg-dark d-flex flex-column justify-content-center">
		<div class="col d-flex flex-column justify-content-center border border-top-0 border-left-0 border-right-0 border-light">
			<h1 class="text-center">Add file</h1>
		</div>
		<div id="files-add-toolbar clearfix">
			<button name="inputUploadFile" id="files-upload" class="w-25"><span class="octicon octicon-cloud-upload"></span></button>
		</div>
	</div>
	<hr class="border-dark w-100">
	<div class="w-100">
		<h1 class="text-center">Uploaded files</h1>
	</div>
	<hr class="border-dark w-100">
	<div id="files-list" class="d-flex flex-column align-items-start">
		<?php 
    		/*echo '<pre>';
    		var_dump($fromController);
    		echo '</pre>';*/
		  foreach($fromController['DATA'] as $fileData){
               $tpl = new Smarty;
               $tpl->template_dir = APPPATH."views\\templates\\";
               $tpl->compile_dir = APPPATH."views\\templates_c\\";
               foreach($fileData as $key => $var){
                   $tpl->assign($key, $var);
               }
               $tpl->display("fileInfo.tpl");
		      
		      
           }
    	?>
	</div>
</div>