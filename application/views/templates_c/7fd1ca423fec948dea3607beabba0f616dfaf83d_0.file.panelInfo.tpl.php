<?php
/* Smarty version 3.1.30, created on 2018-10-20 06:19:16
  from "F:\xampp\htdocs\www\NerPage\application\views\templates\panelInfo.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bcaacc419dfb4_34762973',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fd1ca423fec948dea3607beabba0f616dfaf83d' => 
    array (
      0 => 'F:\\xampp\\htdocs\\www\\NerPage\\application\\views\\templates\\panelInfo.tpl',
      1 => 1540009155,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bcaacc419dfb4_34762973 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container rounded p-0 m-1 w-100 d-flex flex-row-reversed">
	<div class='d-flex align-self-stretch '>
		<a class='btn btn-default border-right-0 border-dark' role='button' href="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
">
			<span class="octicon octicon-chevron-right test-dark"></span>
		</a>
	</div>
	<div id="panel-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="panel bg-dark text-light p-3 w-100 text-left">
		<div class="panelHeader w-100">
			<h4><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</h4>
		</div>
		<hr class="border-light">
		<div class="panelContent">
			<div class="panelDescription">
				<p class="m-0"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</p>
			</div>
		</div>
	</div>
</div><?php }
}
