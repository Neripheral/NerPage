<?php
/* Smarty version 3.1.30, created on 2018-05-12 23:57:07
  from "F:\xampp\htdocs\www\NerPage\application\views\templates\fileInfo.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5af76333e400e7_56167178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1eed52b073558cc6f3f18365e83565cfa754f8fa' => 
    array (
      0 => 'F:\\xampp\\htdocs\\www\\NerPage\\application\\views\\templates\\fileInfo.tpl',
      1 => 1526162224,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af76333e400e7_56167178 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="p-2 w-50">
	<div id="file-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="post container bg-dark text-light rounded p-3 clearfix">
		<div class="fileBoxHeader w-100">
			<a href=<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
><h4><?php echo $_smarty_tpl->tpl_vars['directory']->value;
echo $_smarty_tpl->tpl_vars['filename']->value;?>
</h4></a>
		</div>
		<hr class="border-light">
		<div class="fileBoxDescription">
			<p>Desc</p>
		</div>
		<hr class="border-light">
		<div class="fileBoxFooter">
			<div class="float-left">
				
			</div>
			<p class="text-secondary float-right m-0">Owner:</p>
		</div>
	</div>
</div><?php }
}
