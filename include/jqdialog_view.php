<!-- <link rel="stylesheet" href="<?= POPUP_URL ?>/blitzer/ui.all.css" type="text/css">-->
	
<?php foreach ($this->content as $key => $value) {?>
<div id="popup<?= $key?>" style="background-color: white; display:none" class="popup">
    <?= $value ?>
</div>
<?php } ?>

<script type="text/javascript">
function showPopup(pageId) {
    jQuery('#popup' + pageId).dialog('open');
    return false;
}

jQuery(document).ready(function(){
    <?php $dialogType = (empty(self::$config['sticky']))? 'dialog' : 'isrDialog'; ?>
	jQuery(".popup").<?= $dialogType ?>({ autoOpen: false, modal: true, <?php 
	    if (!empty(self::$config['width'])) echo "width: " . self::$config['width'] . ", ";
	    if (!empty(self::$config['height'])) echo "height: " . self::$config['height'] . ", "; 
	    if (!empty(self::$config['minWidth'])) echo "minWidth: " . self::$config['minWidth'] . ", ";
	    if (!empty(self::$config['minHeight'])) echo "minHeight: " . self::$config['minHeight'] . ", ";
	?> });

	<?php if (!empty(self::$config->hideScrolling)) {?>
	jQuery(".popup").show().bind('dialogclose', function(event, ui) {
		jQuery('html').css('overflow', 'auto');
    });
	jQuery(".popup").show().bind('dialogopen', function(event, ui) {
		jQuery('html').css('overflow', 'hidden');
    });
    <?php } ?>
  });
</script>

<?= $this->text ?>