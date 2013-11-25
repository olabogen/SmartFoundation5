<?php get_header(); ?>

	<div id="primary" class="large-8 columns">
	
		<?php if( have_posts() ) : ?>
            <?php while( have_posts() ) : the_post(); ?> 
        
                <?php get_template_part('list', 'post'); ?>
            
            <?php endwhile; ?>
		
            <?php smart_pagination(); ?>
            
        <?php else : ?>
        
            <?php get_template_part('content', 'notfound'); ?>
        
        <?php endif; ?>
		
	</div><!-- end #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>