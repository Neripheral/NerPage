<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<div class="container">
	<div class="jumbotron">
    	<div class="col">
    		<h1>Create Panel</h1>
    		<hr>
    		<?php 
        	    if(isset($_SESSION["error"])){
        	        echo "<div class='alert alert-danger'>";
        	        echo $_SESSION["error"];
        	        echo "</div>";
        	    }
        	    
        	    echo form_open(base_url('index.php/panelAdd/addPanelFromForm'));
        	    
        	    echo form_fieldset("Name", array("class" => 'p-2'));
        	    echo form_input(array('name' => 'name', 'placeholder' => 'Name of the panel'));
        	    echo form_fieldset_close();
        	    
        	    echo form_fieldset('Description', array('class' => 'p-2'));
        	    echo form_textarea(array('name' => 'description', 'placeholder' => 'What is the purpose of this panel?'));
                echo form_fieldset_close();
                
                echo form_submit(array('class' => 'btn btn-default p-2', 'value' => 'Add Panel'));
                echo form_close();
        	?>
    	</div>
    </div>
</div>
