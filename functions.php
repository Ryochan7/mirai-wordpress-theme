<?php

function mirai_styles_method () {
    wp_register_style ('mirai-cabin-condensed-web-font', 'http://fonts.googleapis.com/css?family=Cabin+Condensed');
    wp_register_style ('mirai-open-sans-web-font', 'http://fonts.googleapis.com/css?family=Open+Sans');
    wp_register_style ('mirai-fredoka-one-web-font', 'http://fonts.googleapis.com/css?family=Fredoka+One');

    wp_enqueue_style ('mirai-cabin-condensed-web-font');
    wp_enqueue_style ('mirai-open-sans-web-font');
    wp_enqueue_style ('mirai-fredoka-one-web-font');
}

add_action ('wp_enqueue_scripts', 'mirai_styles_method');


function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
                        <?php echo get_avatar( $comment, 40 ); ?>
                </div> <!-- .comment-author .vcard -->

                <div class="comment-right">

                    <div class="comment-author-cited">
                            <?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                    </div> <!-- .comment-author-cited -->
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
                            <br />
                    <?php endif; ?>

                    <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php
                                    /* translators: 1: date, 2: time */
                                    printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
                            ?>
                    </div><!-- .comment-meta .commentmetadata -->

                    <div class="comment-body"><?php comment_text(); ?></div>

                    <div class="reply">
                            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div><!-- .reply -->
                </div> <!-- .comment-right -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

function mirai_excerpt ($output)
{
    global $post;
    return "<p>" . $post->post_excerpt . "</p>";
}

add_filter ('the_excerpt', 'mirai_excerpt');

function mirai_widgets_init ()
{
    unregister_sidebar ('secondary-widget-area');
    unregister_sidebar ('third-footer-widget-area');
    unregister_sidebar ('fourth-footer-widget-area');
}

add_action ('widgets_init', 'mirai_widgets_init', 20);

?>
