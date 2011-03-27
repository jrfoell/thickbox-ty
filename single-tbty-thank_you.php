<style>
#header { display: none; }
#footer { display: none; }
</style>
<script type="text/javascript">
	 
</script>
<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>
	<!-- <div>
	<input type="button" name="done" value="Done" onclick="javascript:tb_remove();" />
	</div> -->
	
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
