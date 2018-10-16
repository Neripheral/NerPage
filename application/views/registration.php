<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
	<div class="jumbotron">
    	<div class="col">
    		<h1>Registration</h1>
    		<hr>
    		<?php 
        	    if(isset($_SESSION["error"])){
        	        echo "<div class='alert alert-danger'>";
        	        echo $_SESSION["error"];
        	        echo "</div>";
        	    }
    		    
    		    echo form_open(base_url("index.php/registration/registerUserFromForm"));
                
                echo form_fieldset("Username", array("class" => "p-2"));
                echo form_input(array("name" => "username", "placeholder" => "username"));
                echo form_fieldset_close();
                
                echo form_fieldset("Email address", array("class" => "p-2"));
                echo form_input(array("name" => "email", "placeholder" => "email", "type" => "email"));
                echo form_fieldset_close();
                
                echo form_fieldset("Password", array("class" => "p-2"));
                echo "<div class='row'><div class='col'>";
                echo form_input(array("name" => "password", "placeholder" => "password", "type" => "password"));
                echo "</div></div><div class='row'><div class='col'>";
                echo form_input(array("name" => "passwordRepeat", "placeholder" => "confirm password", "type" => "password"));
                echo "</div></div>";
                echo form_fieldset_close();
                //@idea checking if password is suitable
                //@idea checking if passwords are the same
                
                echo form_submit(array("class" => "btn btn-default p-2", "value" => "Register"));
                
                echo form_close();
        	?>
    	</div>
    </div>
</div>
