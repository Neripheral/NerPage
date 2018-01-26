<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    isset($fromController) OR $fromController = array();
    isset($fromController["POSTS"]) OR $fromController["POSTS"] = array();
    log_message("debug", var_export($fromController, true));
?>

<div id="newsfeed" class="border d-flex flex-column h-100">
	<form action="<?php echo base_url("index.php/newsfeed/addPost"); ?>" method="post" id="postInput" class="w-100 p-0">
		<input name="title" placeholder="Title..." class="w-100 d-block">
		<textarea name="content" placeholder="What are the news...?" class="w-100 d-block"></textarea>
		<div class="w-100 m-0 bg-dark">
			<button type="submit" id="addPostButton" class="bg-dark text-light border-right-0 border-top-0 border-bottom-0">
				<span class="octicon octicon-light octicon-plus text-light"></span>
				Add post
			</button>
		</div>
	</form>
	<div id="posts" class="d-flex flex-column align-items-start">
		<?php 
		  foreach($fromController["POSTS"] as $post){
               $tpl = new Smarty;
               $tpl->template_dir = APPPATH."views\\templates\\";
               $tpl->compile_dir = APPPATH."views\\templates_c\\";
               
               foreach($post as $key => $var){
                   $tpl->assign($key, $var);
               }
               $tpl->display("post.tpl");
           }
    	?>
	</div>
</div>