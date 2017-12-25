<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<main>
	<div class="container">
    	<div class="row bg-light text-center p-3">
        	<div class="col">
        		<h1>Sign In</h1>
        		<hr>
        		<?php 
            		if(isset($_SESSION["error"])){
            		    echo "<div class='alert alert-danger'>";
            		    echo $_SESSION["error"];
            		    echo "</div>";
            		}
            		
                    echo form_open(base_url("index.php/signing/logByForm"));
                    
                    echo form_fieldset("Username", array("class" => "p-2"));
                    echo form_input(array("name" => "username", "placeholder" => "username"));
                    echo form_fieldset_close();
                    
                    echo form_fieldset("Password", array("class" => "p-2"));
                    echo form_input(array("name" => "password", "placeholder" => "password", "type" => "password"));
                    echo form_fieldset_close();
                    //@idea "remember me" button 
                    echo form_submit(array("class" => "btn btn-default p-2", "value" => "Sign In"));
                    
                    echo form_close();
            	?>
        	</div>
        </div>
    </div>
</main>