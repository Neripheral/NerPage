<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    /*
     * Receives:
     * $fromController["NAVBAR"][0-?]["text"      -   Name of the tab
     *                                "href"      -   Address the tab should link to
     *                                "class"];   -   Styling classes
     */

//@todo: Check if all variables are set or set them. 
    
?>
<nav class="navbar navbar-dark navbar-expand bg-dark">
    <div class="container-fluid">
    	<div class="navbar-header">
    		<a class="navbar-brand text-light">NerPage</a>
    	</div>
    	<ul class="nav navbar-nav">
        	<?php 
        	   foreach($fromController["NAVBAR"] as $tab){
        	       $tpl = new Smarty;
        	       $tpl->template_dir = APPPATH."views\\templates\\";
        	       $tpl->compile_dir = APPPATH."views\\templates_c\\";
        	       
        	       foreach($tab as $key => $var){
        	           $tpl->assign($key, $var);
        	       }
        	       $tpl->display("navbar_navtabs.tpl");
        	   }
        	?>
    	</ul>
	</div>
</nav>