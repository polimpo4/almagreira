<?php

global $cs_theme_option;

if (comments_open()) {

    if (post_password_required())

        return;

    ?>

    <?php if (have_comments()) : ?>

        <div id="comments">

            <header>

                <h2 class="heading-color section-title uppercase"><?php echo comments_number(__('No Comments', 'Mercycorp'), __('1 Comment', 'Mercycorp'), __('% Comments', 'Mercycorp')); ?></h2>

            </header>

            <ul>

                <?php wp_list_comments(array('callback' => 'PixFill_comment')); ?>

            </ul>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?  ?>

                <div class="navigation">

                    <div class="nav-previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'Mercycorp')); ?></div>

                    <div class="nav-next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'Mercycorp')); ?></div>

                </div> <!-- .navigation -->

            <?php endif; // check for comment navigation  ?>



            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?  ?>

                <div class="navigation">

                    <div class="nav-previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'Mercycorp')); ?></div>

                    <div class="nav-next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'Mercycorp')); ?></div>

                </div><!-- .navigation -->

            <?php endif; ?>

        </div>

    <?php endif; // end have_comments()  ?>



    <?php

    global $post_id;

    $you_may_use = __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'Mercycorp');

    $must_login = __('You must be <a href="%s">logged in</a> to post a comment.', 'Mercycorp');

    $logged_in_as = __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'Mercycorp');

    $required_fields_mark = ' ' . __('Required fields are marked %s', 'Mercycorp');

    $required_text = sprintf($required_fields_mark, '<span class="required">*</span>');



    $defaults = array('fields' => apply_filters('comment_form_default_fields', array(

            'notes' => '<p class="comment-notes">

                            </p>',

            'author' => '<p class="comment-form-author">' .

            '<label for="author">' . __('Nome', 'Mercycorp') .

            '<span>' . ( $req ? __('(required)', 'Mercycorp') : '' ) . '</span></label><input id="author" name="author" class="nameinput" type="text" value="' .

            esc_attr($commenter['comment_author']) . '" size="30" tabindex="1"  />' .

            '</p><!-- #form-section-author .form-section -->',

            'email' => '<p class="comment-form-email">' .

            '<label for="email">' . __('Email', 'Mercycorp') .

            '<span>' . ( $req ? __('(required)', 'Mercycorp') : '' ) . '</span></label>' .

            '<input id="email" name="email" class="emailinput" type="text"  value="' .

            esc_attr($commenter['comment_author_email']) . '" size="30" tabindex="2"/>' .

            '</p><!-- #form-section-email .form-section -->',

            'url' => '<p class="comment-form-website">' .

            '<label for="url">' . __('Website', 'Mercycorp') . '<span></span></label>' .

            '<input id="url" name="url" type="text" class="websiteinput"  value="' . esc_attr($commenter['comment_author_url']) . '" size="30" tabindex="3" />' .

            '</p><!-- #<span class="hiddenSpellError" pre="">form-section-url</span> .form-section -->')),

        'comment_field' => '<p class="comment-form-comment fullwidth">' .

        '<label for="comment">' . __('Comment:', 'Mercycorp') . '<span>' . ( $req ? __('(required)', 'Mercycorp') : '' ) . '</span></label>' .

        '<textarea id="comment" name="comment"  class="commenttextarea" rows="4" cols="39"></textarea>' .

        '</p><!-- #form-section-comment .form-section -->',

        'must_log_in' => '<p class="must-log-in">' . sprintf($must_login, wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',

        'logged_in_as' => '<p class="logged-in-as">' . sprintf($logged_in_as, admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))),

        'comment_notes_before' => '',

        'comment_notes_after' => '',

        'id_form' => 'commentform',

        'id_submit' => 'submit-comment',

        'title_reply' => __('Leave a Comment', 'Mercycorp'),

        'title_reply_to' => __('Leave a Reply to %s', 'Mercycorp'),

        'cancel_reply_link' => __('Cancel reply', 'Mercycorp'),

        'label_submit' => __('Submit', 'Mercycorp'),);

    comment_form($defaults, $post_id);

    ?>



    <?php

}?>