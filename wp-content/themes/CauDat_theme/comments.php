<?php if (have_comments()) : ?>
    <div class="comment-content">
        <h5 class="comment-content__header">
            <?php
            $num_cmt =  (int)get_comments_number();
            echo $num_cmt < 10 ? 0 . $num_cmt  . '&ensp;Bình luận' : $num_cmt  . '&ensp;Bình luận';
            ?>
        </h5>
        <ul class="comment-content__list">
            <?php
            $args_cmt = array (
                'type'    	  => 'comment',
				'walker'      => new Caudat_Custom_Walker_Comment,
				'max_depth'   => 2
            );
            
            wp_list_comments($args_cmt) ?>
        </ul>
    </div>
<?php endif; ?>

<div class="comment-form-ctn">
    <?php
    $comments_arg = array(
        'form'    => array(
            'class' => 'form-horizontal'
        ),
        'comment_field'            => '<div class="form-group field-comment">' .
            '<textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true" placeholder="Bình luận"></textarea>' .
            '</div>',

        'fields' => apply_filters(
            'comment_form_default_fields',
            array(
                'author' => '<div class="form-group field-author">' .
                    '<input id="author" name="author" class="form-control" type="text"  size="30" placeholder="Họ và Tên" />
								</div>',

                'email' => '<div class="form-group field-email">' .
                    '<input type="email" id="email" name="email" class="form-control" type="text" size="30" placeholder="Email" />
								</div>',
                'cookies'               => '',
            )
        ),
        'comment_notes_after'     => '',
        'title_reply'            => 'Bình luận của bạn',
        'title_reply_to'        => 'Trả lời bình luận của %s',
        'cancel_reply_link'        => '( Hủy )',
        'comment_notes_before'    => '',


        'label_submit'            => 'Gửi'
    );

    comment_form($comments_arg);
    ?>

</div>