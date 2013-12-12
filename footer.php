            </div> <!-- end #main -->
            
            <footer id="site-footer" class="row" role="contentinfo">
                <hr />
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="medium-4 large-4 columns">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <div class="medium-4 large-4 columns">
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="medium-4 large-4 columns">
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                </div>
                <?php endif; ?>
            </footer>
        
        </div><!-- end #inner-page -->
    </div><!-- end #page -->
    
    <div id="site-generator" class="row">
        <div class="large-12 columns">
            <?php _e('Built on WordPress by', 'smart_foundation'); ?> <a href="http://smartmedia.no/" title="Trykk her for å gå til nettsiden" target="_blank">Smart Media AS</a>
            <!-- <span class="sep"> &bull; </span>
    <?php _e('Design by', 'smart_foundation'); ?> <a href="http://www.wow-medialab.com" title="Trykk her for å gå til nettsiden" target="_blank">WOW medialab</a> -->
        </div>
    </div>

<?php wp_footer(); ?>
<script>
    jQuery(document).ready(function($){
        $(document).foundation('topbar', {
            custom_back_text: true,
            back_text: "<?php _e('Back', 'smart_foundation'); ?>",
            scrolltop: false,
            mobile_show_parent_link: false,
        });
    });
</script>

</body>
</html>