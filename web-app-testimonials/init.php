<?php  

	/* 
		Plugin Name: Web Apps Testimonials
		Plugin URI: http://asrafulhaq.com
		Author: Web Apps All Students
		Author URI:  http://asrafulhaq.com
		Version: 1.0.0
		Description: This is a very simple plugins for testimonials. you can try it. 
	*/



	add_action('wp_enqueue_scripts', 'web_apps_file');


	function web_apps_file(){



		wp_enqueue_style('assets', PLUGINS_URL('assets/css/font-awesome.min.css', __FILE__));
		wp_enqueue_style('bootstrap', PLUGINS_URL('assets/css/bootstrap.min.css', __FILE__));
		wp_enqueue_style('style-app-web', PLUGINS_URL('assets/css/style.css', __FILE__));


		
		wp_enqueue_script('popper', PLUGINS_URL('assets/js/popper.min.js', __FILE__), ['jquery'], true, true);
		wp_enqueue_script('bootstrap', PLUGINS_URL('assets/js/bootstrap.min.js', __FILE__), ['jquery'], true, true);
		wp_enqueue_script('main-web-app', PLUGINS_URL('assets/js/main.js', __FILE__), ['jquery'], true, true);

	}





	add_action('after_setup_theme','testimonial_setup');

	function testimonial_setup(){

		register_post_type('testi', [
			'public'			=> true,
			'labels'			=> [
				'name'				=> 'Testiminials',
				'all_items'			=> 'All Testimonials',
				'add_new'			=> 'Add Testiminials',
				'add_new_item'		=> 'Add new Testiminials'
			],
			'supports'				=> ['title','editor','thumbnail'],
			'menu_icon'				=> 'dashicons-smiley'
		]);


	}







	add_shortcode('testimonials_web_apps', 'testimonials_web_apps');


	function testimonials_web_apps(){ ?>

		
		<div id="testimonial" class="testimonials-app carousel slide" data-ride="carousel">
				
			<ul class="carousel-indicators">
				<li data-target="#testimonial" data-slide-to="0" class="active"></li>
				<li data-target="#testimonial" data-slide-to="1"></li>
				<li data-target="#testimonial" data-slide-to="2"></li>
			</ul>



			<div class="carousel-inner">






				<?php 
					$testi = new WP_Query([
						'post_type'			=> 'testi',
						'posts_per_page'	=> 6
					]);

					$i = 1;

				while( $testi -> have_posts() ) : $testi -> the_post(); ?>


				<div class="carousel-item <?php if( $i == 1 ){ echo "active"; } $i ++; ?>">				
					<q><?php echo wp_trim_words(get_the_content(), 50, false); ?></q>
					<?php the_post_thumbnail(); ?>
					<h3><?php the_title(); ?></h3>
				</div>
				<?php endwhile; ?>

				



			</div>


			<a class="carousel-control-prev" href="#testimonial" data-slide="prev">
			    <span class="carousel-control-prev-icon"></span>
			  </a>
			  <a class="carousel-control-next" href="#testimonial" data-slide="next">
			    <span class="carousel-control-next-icon"></span>
			  </a>

		</div>




	<?php }


