<?php if ( get_sub_field( 'number_of_columns' ) == 1 ) : ?>
    <section class="text_with_icons two_col">
        <div class="container">
            <div class="title_block">
                <h2><?php the_sub_field( 'block_title' ); ?></h2>
            </div>
            <div class="block_wrap">
                <?php if ( have_rows( 'block_items' ) ) : ?>
                    <?php while ( have_rows( 'block_items' ) ) : the_row(); ?>
                        <div class="item">
                            <div class="ico">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1115_57930)">
                                        <path d="M32.596 16.576L35.404 19.426L23.818 30.84C23.044 31.614 22.026 32 21.004 32C19.982 32 18.954 31.61 18.172 30.83L12.608 25.438L15.394 22.564L20.98 27.978L32.596 16.576ZM48 24C48 37.234 37.234 48 24 48C10.766 48 0 37.234 0 24C0 10.766 10.766 0 24 0C37.234 0 48 10.766 48 24ZM44 24C44 12.972 35.028 4 24 4C12.972 4 4 12.972 4 24C4 35.028 12.972 44 24 44C35.028 44 44 35.028 44 24Z" fill="#00A1D4"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1115_57930">
                                            <rect width="48" height="48" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="item_title">
                                <span><?php the_sub_field( 'item_title' ); ?></span>
                            </div>
                            <div class="item_text">
                                <?php the_sub_field( 'item_text' ); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="text_with_icons three_col">
        <div class="container">
            <div class="title_block">
                <h2><?php the_sub_field( 'block_title' ); ?></h2>
            </div>
            <div class="block_wrap">
                <?php if ( have_rows( 'block_items' ) ) : ?>
                    <?php while ( have_rows( 'block_items' ) ) : the_row(); ?>
                        <div class="item">
                            <div class="ico">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1115_57930)">
                                        <path d="M32.596 16.576L35.404 19.426L23.818 30.84C23.044 31.614 22.026 32 21.004 32C19.982 32 18.954 31.61 18.172 30.83L12.608 25.438L15.394 22.564L20.98 27.978L32.596 16.576ZM48 24C48 37.234 37.234 48 24 48C10.766 48 0 37.234 0 24C0 10.766 10.766 0 24 0C37.234 0 48 10.766 48 24ZM44 24C44 12.972 35.028 4 24 4C12.972 4 4 12.972 4 24C4 35.028 12.972 44 24 44C35.028 44 44 35.028 44 24Z" fill="#00A1D4"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1115_57930">
                                            <rect width="48" height="48" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="item_title">
                                <span><?php the_sub_field( 'item_title' ); ?></span>
                            </div>
                            <div class="item_text">
                                <?php the_sub_field( 'item_text' ); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
