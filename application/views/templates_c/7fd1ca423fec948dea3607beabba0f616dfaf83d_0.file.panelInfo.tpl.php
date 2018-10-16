<?php
/* Smarty version 3.1.30, created on 2018-05-12 23:52:02
  from "F:\xampp\htdocs\www\NerPage\application\views\templates\panelInfo.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5af7620216d632_69654578',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fd1ca423fec948dea3607beabba0f616dfaf83d' => 
    array (
      0 => 'F:\\xampp\\htdocs\\www\\NerPage\\application\\views\\templates\\panelInfo.tpl',
      1 => 1526161898,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af7620216d632_69654578 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="p-2 w-100">
	<div id="panel-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="panel container bg-dark text-light rounded p-3">
		<div class="panelHeader w-100">
			<a href="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
"><button>
				<h4><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 <span class="octicon octicon-chevron-right"></span></h4>
			</button></a>
		</div>
		<hr class="border-light">
		<div class="panelContent">
			<div class="panelDescription">
				<p class="m-0"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</p>
			</div>
		</div>
		<hr class="border-light">
	</div>
</div><?php }
}
