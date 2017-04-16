<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hunter_Douglas_Hospitality
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper-footer">
            <nav id="footer-navigation" class="footer-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
            </nav><!-- #site-navigation -->
            <div class="footer-newsletter">
                <span>Subscribe to news and announcements.</span> <button>Join now</button>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


</div><!-- #page -->

</div>
<?php wp_footer(); ?>
<script
        src="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.js"
        type="text/javascript"
        charset="utf-8"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.min.js" type="text/javascript"
        charset="utf-8"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.gallery.min.js"
        type="text/javascript" charset="utf-8"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/min/jquery.matchHeight.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/flexnav/js/jquery.flexnav.js';?>"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/js/jquery-mTab-min.js"></script>

<script>


    jQuery(document).ready(function () {

        jQuery('#primary-menu, .secondary-navigation').mouseenter(function () {
//  jQuery('.logo-2').css('opacity', '1');
//  jQuery('.logo-1').css('opacity', '0');
            jQuery('.site-header').addClass('black');
        })
            .mouseleave(function(){
//  jQuery('.logo-1').css('opacity', '1');
// jQuery('.logo-2').css('opacity', '0');
            jQuery('.site-header').removeClass('black');
        });

        jQuery('.sub-menu:before, .sub-menu:after').mouseenter(function(){
//  jQuery('.logo-1').css('opacity', '1');
// jQuery('.logo-2').css('opacity', '0');
            jQuery('.site-header').removeClass('black');
        });

        jQuery('.search-toggle').click(function(){
            jQuery('.site-header').addClass('searching');
        });
jQuery('.dt-search-close').click(function(){
            jQuery('.site-header').removeClass('searching');
        });





        jQuery('#secondary-navigation .search-field').focusin(function () {
          //  jQuery('.logo-2').css('opacity', '1');
          //  jQuery('.logo-1').css('opacity', '0');
            jQuery('.site-header').addClass('searching');
            });
        jQuery('#secondary-navigation .search-field').focusout(function () {
            //jQuery('.logo-1').css('opacity', '1');
           // jQuery('.logo-2').css('opacity', '0');
            jQuery('.site-header').removeClass('searching');
        });



        jQuery('.menu-button').click(function(){
            jQuery('.site-header').toggleClass('black');
        });



        });




    jQuery(document).ready(function () {
        jQuery('.waiting').removeClass('waiting');
    });



//    Sales rep functionality

    jQuery(function($){
        $('#filter').change(function(){
            var filter = $(this);
            $.ajax({
                url:filter.attr('action'),
                data:filter.serialize(), // form data
                type:filter.attr('method'), // POST
                beforeSend:function(xhr){

                    jQuery('#response').addClass('hidden'); // changing the button label
                    jQuery('.looking').removeClass('hidden'); // changing the button label
                },
                success:function(data){
                    //filter.find('button').text('Apply filter'); // changing the button label back

                    jQuery('.looking').addClass('hidden'); // changing the button label
                    $('#response').html(data); // insert data
                    jQuery('#response').removeClass('hidden'); // changing the button label
                }
            });
            return false;
        });
    });
    jQuery(document).ready(function () {
        jQuery('.sales-rep-link, .sales-rep-cta').click(function () {
            jQuery('.sales-rep-modal').removeClass('hidden');
        });
        jQuery('.sales-rep-close').click(function () {
            jQuery('.sales-rep-modal').addClass('hidden');
        });

        jQuery('.sales-rep-modal').click(function() {
            jQuery('.sales-rep-modal').addClass('hidden');
        });

        jQuery('.sales-rep-wrapper').click(function(event){
            event.stopPropagation();
        });
    });



    //add attritibute to mobile menu
   jQuery(document).ready(function() {
       jQuery(".flexnav").flexNav({
           'hover': true,
       });
   });



    jQuery('li .touch-button').click(function() {
        if(jQuery(this).hasClass('active')){
            console.log('thing');
            jQuery(this).closest('.menu-item').addClass("open-item");
        }else{
            jQuery(this).parent().removeClass("open-item");
        }
    });


</script>
<section class="sales-rep-modal hidden" >
    <div class="sales-rep-wrapper">
        <button class="sales-rep-close"></button>
        <h2>Find a sales representative</h2>
        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
			<?php
			if( $terms = get_terms( 'region', 'orderby=name' ) ) : // to make it simple I use default categories
				echo '<select name="categoryfilter"><option>Select a region</option>';
				foreach ( $terms as $term ) :
					echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
				endforeach;
				echo '</select>';
			endif;
			?>

            <input type="hidden" name="action" value="myfilter">
        </form>
        <div class="looking hidden"></div>
        <div id="response"></div>
        <div class="contact-us"><?php the_field( 'contact_us_text', 'option' ); ?></div>
    </div>
</section>
</body>
</html>
