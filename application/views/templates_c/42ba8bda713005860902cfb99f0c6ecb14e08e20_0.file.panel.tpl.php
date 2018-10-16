<?php
/* Smarty version 3.1.30, created on 2018-05-07 15:48:57
  from "F:\xampp\htdocs\www\NerPage\application\views\templates\panel.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5af05949169294_79159113',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42ba8bda713005860902cfb99f0c6ecb14e08e20' => 
    array (
      0 => 'F:\\xampp\\htdocs\\www\\NerPage\\application\\views\\templates\\panel.tpl',
      1 => 1525700663,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af05949169294_79159113 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="p-2 w-100">
	<div id="panel-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="panel container bg-dark text-light rounded p-3">
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
			<a href="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
"><button>
				<span class="octicon octicon-chevron-right"></span>
			</button></a>
		</div>
		<hr class="border-light">
	</div>
</div><?php }
}
