<?php get_header(); ?>

    <div class="site-error">
        <div class="site-error__content">
            <h1 class="heading">
                404
            </h1>

            <p>
				<?php esc_html_e('The page you are looking for might have been removed had its name changed or is temporarily unavailable.', 'lpbcolor'); ?>
            </p>

            <a href="<?php echo esc_url( get_home_url('/') ); ?>">
				<?php esc_html_e('Home Page', 'lpbcolor'); ?>
            </a>
        </div>
    </div>

<?php get_footer(); ?>