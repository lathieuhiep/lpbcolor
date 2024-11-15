<?php while ( have_posts() ) : the_post() ; ?>
    <div class="site-page-content">
        <?php
        the_content();
        lpbcolor_link_page();
        ?>
    </div>
<?php endwhile; ?>