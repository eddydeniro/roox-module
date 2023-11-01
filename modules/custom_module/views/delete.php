<?php echo ajax_modal_template_header(TEXT_HEADING_DELETE) ?>

<?php $obj = db_find($custom_module_table, $_GET['id']); ?>

<?php echo form_tag('vars', url_for("$plugin_name/custom_module/code",'action=delete&id=' . $_GET['id'] )) ?>
    
<div class="modal-body">    
<?php echo sprintf(TEXT_DEFAULT_DELETE_CONFIRMATION,$obj['name'])?>
</div> 
 
<?php echo ajax_modal_template_footer(TEXT_BUTTON_DELETE) ?>

</form>    