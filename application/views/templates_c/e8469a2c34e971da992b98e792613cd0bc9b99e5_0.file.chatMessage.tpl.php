<?php
/* Smarty version 3.1.30, created on 2017-12-26 02:22:02
  from "F:\xampp\htdocs\www\NerPage\application\views\templates\chatMessage.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a41a43a525629_87866863',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8469a2c34e971da992b98e792613cd0bc9b99e5' => 
    array (
      0 => 'F:\\xampp\\htdocs\\www\\NerPage\\application\\views\\templates\\chatMessage.tpl',
      1 => 1514251319,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a41a43a525629_87866863 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="p-1">
	<div id="chatMessage-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="chatMessage container bg-light rounded p-2">
		<p class="m-0">
			<strong class="text-secondary"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</strong>
			<br>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		</p>
	</div>
</div><?php }
}
