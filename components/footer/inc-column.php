<?php
$introduce = lpbcolor_get_option('opt_footer_introduce');
$contact = lpbcolor_get_option('opt_footer_contact');
$quick_link = lpbcolor_get_option('opt_footer_quick_link');
?>

<div class="global-footer__column">
    <div class="container">
        <div class="grid d-flex flex-column flex-md-row justify-content-between column-gap-4 row-gap-8">
            <div class="item d-flex flex-column gap-10">
                <div class="introduce">
                    <div class="logo mb-3">
                        <?php
                        if ( !empty( $introduce['logo'] ) ):
                            echo wp_get_attachment_image( $introduce['logo']['id'], 'medium' );
                        endif;
                        ?>
                    </div>

                    <?php if ( $introduce['heading'] ) : ?>
                        <h4 class="heading mb-2">
                            <?php echo esc_html( $introduce['heading'] ); ?>
                        </h4>
                    <?php endif; ?>

                    <?php if ( $introduce['sub_heading'] ) : ?>
                        <p class="sub-heading">
                            <?php echo esc_html( $introduce['sub_heading'] ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="contact d-flex flex-column gap-3">
                    <?php if ( $contact['phone_list'] ): ?>

                    <div class="contact__item phone-list">
                        <div class="icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        
                        <ul class="phones reset-list d-flex gap-4">
                            <?php foreach ( $contact['phone_list'] as $phone ) : ?>
                            <li>
                                <a href="tel:<?php echo esc_attr( lpbcolor_preg_replace_ony_number( $phone['number'] ) ); ?>">
                                    <?php echo esc_html( $phone['number'] ); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <?php endif; ?>

                    <?php if ( $contact['link_website'] ) : ?>

                    <div class="contact__item">
                        <div class="icon">
                            <i class="fas fa-globe"></i>
                        </div>

                        <a href="<?php echo esc_url( $contact['link_website']['url'] ); ?>"
                           target="<?php esc_attr( $contact['link_website']['target'] ); ?>"
                        >
                            <?php echo esc_html( $contact['link_website']['text'] ); ?>
                        </a>
                    </div>

                    <?php endif; ?>

                    <?php if ( $contact['address'] ) : ?>

                    <div class="contact__item">
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>

                        <p class="address">
                            <?php echo nl2br( $contact['address'] ); ?>
                        </p>
                    </div>

                    <?php endif; ?>

                    <?php if ( $contact['address_2'] ) : ?>

                        <div class="contact__item">
                            <div class="icon">
                                <i class="fas fa-boxes-stacked"></i>
                            </div>

                            <p class="address">
                                <?php echo nl2br( $contact['address_2'] ); ?>
                            </p>
                        </div>

                    <?php endif; ?>
                </div>
            </div>

            <div class="item d-flex flex-column gap-10 justify-content-end">
                <?php if ( $quick_link['menus'] ) : ?>
                <div class="menus d-flex flex-lg-wrap gap-4 gap-lg-8">
                    <?php
                    foreach ( $quick_link['menus'] as $menus):
                        $menu_items = wp_get_nav_menu_items($menus);
                    ?>
                    <ul class="reset-list flex-grow-0 flex-shrink-1">
                        <?php foreach ( $menu_items as $menu) : ?>
                        <li>
                            <a href="<?php echo esc_url( $menu->url ); ?>">
                                <?php echo esc_html( $menu->title ); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ( $quick_link['opt_tiktok_list'] ) : ?>
                <div class="tiktok-warp d-flex flex-wrap gap-4">
                    <?php foreach ( $quick_link['opt_tiktok_list'] as $tiktok) : ?>
                        <a class="link d-inline-flex align-items-center gap-5" href="<?php echo esc_url( $tiktok['url'] ); ?>" target="_blank">
                            <?php if ( $tiktok['avatar'] ) : ?>
                                <figure class="avatar">
                                    <?php echo wp_get_attachment_image( $tiktok['avatar']['id'] ); ?>
                                </figure>
                            <?php endif; ?>

                            <span class="text"><?php echo esc_html( $tiktok['channel_name'] ); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
