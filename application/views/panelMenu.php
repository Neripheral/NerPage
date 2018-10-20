<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    isset($fromController) OR $fromController = array();
    isset($fromController["PANELS"]) OR $fromController["PANELS"] = array();
    foreach($fromController["PANELS"] as &$panel){
        isset($panel["id"]) OR $panel["id"] = 'error_id_not_found';
        isset($panel["name"]) OR $panel["name"] = 'error_name_not_found';
        isset($panel["description"]) OR $panel["description"] = 'error_description_not_found';
    }
?>

<div class='container'>
    <div class='jumbotron'>
        <div class='panel-create rounded w-100'>
        	<div class="panelHeader w-100 m-0">
        		<a class='w-100' href='<?php echo base_url('index.php/panelAdd');?>'><button class='w-100 btn btn-default p-2'>
        			<h4>Add Panel</h4>
        		</button></a>
        	</div>
        </div>
        <hr class='border-dark mb-5 mt-5'>
        <div id="panels" class="border d-flex flex-column h-100 w-100">
        	<div id="panels-list" class="d-flex flex-column align-items-start w-100">
        		<?php 
        		  foreach($fromController["PANELS"] as &$panel){
                       $tpl = new Smarty;
                       $tpl->template_dir = APPPATH."views\\templates\\";
                       $tpl->compile_dir = APPPATH."views\\templates_c\\";
                       
                       foreach($panel as $key => $var){
                           $tpl->assign($key, $var);
                       }
                       $tpl->display("panelInfo.tpl");
                   }
            	?>
        	</div>
		</div>
	</div>
</div>