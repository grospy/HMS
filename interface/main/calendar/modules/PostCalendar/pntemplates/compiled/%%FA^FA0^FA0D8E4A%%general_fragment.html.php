<?php /* Smarty version 2.6.31, created on 2018-08-29 11:45:30
         compiled from /Applications/MAMP/htdocs/HMS/templates/prescription/general_fragment.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xl', '/Applications/MAMP/htdocs/HMS/templates/prescription/general_fragment.html', 13, false),array('modifier', 'escape', '/Applications/MAMP/htdocs/HMS/templates/prescription/general_fragment.html', 13, false),)), $this); ?>
<table>
  <?php if (empty ( $this->_tpl_vars['prescriptions'] )): ?>
        <tr class='text'>
                <td>&nbsp;&nbsp;<?php echo smarty_function_xl(array('t' => ((is_array($_tmp='None')) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))), $this);?>
</td>
        </tr>
  <?php endif; ?>
	<?php $_from = $this->_tpl_vars['prescriptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prescription']):
?>
  <?php if ($this->_tpl_vars['prescription']->get_active() > 0): ?>
	<tr class='text'>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->drug)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_dosage_display())) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
	</tr>
  <?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</table>