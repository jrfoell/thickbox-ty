<div class="wrap">
	 <?php screen_icon(); ?>
	<h2>Thank You Page</h2>
<form name="post" method="post" id="post" action="admin.php?page=<?= $this->page ?>">
<div id="poststuff" class="metabox-holder">
<div id="post-body">
<div id="post-body-content">

<div id="postdivrich" class="postarea">
<script type="text/javascript">	 
jQuery(document).ready(function($) {
 
 var id = "content";
 
    $('a.toggleVisual').click(
        function() {
            tinyMCE.execCommand('mceAddControl', false, id);
        }
    );
 
    $('a.toggleHTML').click(
        function() {
            tinyMCE.execCommand('mceRemoveControl', false, id);
        }
    );

 
});
</script>
<?php
  wp_tiny_mce( false , array( "editor_selector" => "content",
  							"height" => 300));
?>
<div id="editor-toolbar">
<p align="right" style="float:right;">
    <a class="button toggleVisual">Visual</a>
    <a class="button toggleHTML">HTML</a>
</p>
<div id="media-buttons" class="hide-if-no-js"><?php media_buttons(); ?></div>
</div>
<textarea class="content" id="content" name="content" rows="25" cols="80"><?php echo $this->content; ?></textarea>
<table id="post-status-info" cellspacing="0"><tbody><tr>
	<td id="wp-word-count"></td>
	<td class="autosave-info">
	<span id="autosave">&nbsp;</span>
</td>
</tr></tbody></table>
</div><!-- /postdivrich -->
	<?php if( $this->url ):?>
		<div>Your Thank You page URL is: <?php echo $this->url; ?></div>
	<? endif; ?>
</div><!-- /post-body-content -->
</div><!-- /post-body -->
<br class="clear" />
	 
<div id="submitpost" class="submitbox"> 
<div id="major-publishing-actions">
<div id="publishing-action">
	<input type="submit" name="save" id="save" class="button-primary" value="Save Thank You" />
</div>
<div class="clear"></div>
</div><!-- /major-publishing-actions -->
</div><!-- /submitpost -->

</div><!-- /poststuff -->
</form>
</div><!-- /wrap -->
