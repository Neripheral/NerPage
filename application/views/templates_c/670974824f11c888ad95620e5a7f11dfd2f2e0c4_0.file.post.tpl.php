<?php
/* Smarty version 3.1.30, created on 2018-01-26 04:24:26
  from "F:\xampp\htdocs\www\NerPage\application\views\templates\post.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a6a9f6a4cddb9_18385280',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '670974824f11c888ad95620e5a7f11dfd2f2e0c4' => 
    array (
      0 => 'F:\\xampp\\htdocs\\www\\NerPage\\application\\views\\templates\\post.tpl',
      1 => 1516936436,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a6a9f6a4cddb9_18385280 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="p-2 w-100">
	<div id="post-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="post container bg-dark text-light rounded p-3">
		<div class="postHeader w-100">
			<h4><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h4>
		</div>
		<hr class="border-light">
		<div class="postContent">
			<p><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</p>
		</div>
		<hr class="border-light">
		<div class="postFooter">
			<div class="float-left">
				<button class="post-upvote-button <?php echo $_smarty_tpl->tpl_vars['upvote']->value;?>
"><span class="octicon octicon-thumbsup"></span></button>
				<?php echo $_smarty_tpl->tpl_vars['rating']->value;?>

				<button class="post-downvote-button <?php echo $_smarty_tpl->tpl_vars['downvote']->value;?>
"><span class="octicon octicon-thumbsdown"></span></button>
			</div>
			<p class="text-secondary float-right m-0">Added by: <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
		</div>
	</div>
</div><?php }
}
