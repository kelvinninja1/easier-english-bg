<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

    <?php
        $enableExam = get_post_meta( $post->ID, 'enableExam', true );

        if ( $enableExam == "true" ) {
    ?>
        <div id="exam_popup" class="examWrapper" style="display: none;">
            <span id="close_exam" class="close_popup" title="Върни се към урока">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.427 3.021h-7.427v-3.021l-6 5.39 6 5.61v-3h7.427c3.071 0 5.561 2.356 5.561 5.427 0 3.071-2.489 5.573-5.561 5.573h-7.427v5h7.427c5.84 0 10.573-4.734 10.573-10.573s-4.733-10.406-10.573-10.406z"/></svg>
                Назад към урока
            </span>
            <h4>Упражнение<br /> <span>към урока за <?= the_title(); ?></span></h4>

            <div class="result"></div>
            <div class="share_result">
                <a id="ref_fb" class="custom_fb_share" href="javascript:;" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600'); return false;">Сподели с приятели</a>
            </div>
            <ol id="exam">
                <?php
                    for( $i = 1; $i <= 10; $i++ ){
                        $examArr =  get_post_meta( $post->ID, 'examArr' . $i, true );
                        $m = 0;
                        ?>
                        <li>
                            <?= $examArr[$m]; ?>
                            <div data-true="X" class="option"><div class="checkbox left"></div><span class="text"><?= $examArr[$m + 1]; ?></span></div>
                            <div data-true="" class="option" data-error-message="<?= $examArr[$m + 3]; ?>"><div class="checkbox left"></div><span class="text"><?= $examArr[$m + 2]; ?></span></div>
                            <div data-true="" class="option" data-error-message="<?= $examArr[$m + 5]; ?>"><div class="checkbox left"></div><span class="text"><?= $examArr[$m + 4]; ?></span></div>
                            <div class="error_message" data-no-answer="Не си избрал отговор."></div>
                        </li>
                <?php } ?>

                <!--
                <li>
                    I __________ for 7 hours a day.
                    <div data-true="X" class="option"><div class="checkbox left"></div><span class="text">sleep</span></div>
                    <div data-true="" class="option" data-error-message="Опитай пак. Използваме „s”-формата само при 3л. ед.ч – He/She/It"><div class="checkbox left"></div><span class="text">sleeps</span></div>
                    <div data-true="" class="option" data-error-message="Опитай пак. Това е форма за събитие, което се случва в момента на говорене. Виж Present Continuous."><div class="checkbox left"></div><span class="text">am sleeping</span></div>
                    <div class="error_message" data-no-answer="Не си избрал отговор."></div>
                </li>
                -->
            </ol>

            <hr />

            <!-- <div class="result"></div> -->

            <button id="check_results" class="slim_button bigResult_button">Провери упражнението</button>

        </div>
    <?php } ?>

    <div id="primary" class="site-content">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'superFormat' ); ?>

            <dl id="questions_accordion" class="questions_holder">
                <?php
                    $questions = get_post_meta( $post->ID, 'questions', true );
                    $answers = get_post_meta( $post->ID, 'answers', true );
                    if ( strlen($questions[0]) > 0 ){
                        echo '<h3 class="widget-title">Зададени до момента въпроси към урока:</h3>';
                        for( $i = 0; $i < sizeof($questions); $i++ ){
                            if ( strlen($questions[$i]) > 0 && strlen($answers[$i]) > 0 ){
                                echo '<dt><a href="javascript:;">' . $questions[$i] . '</a></dt>';
                                echo '<dd>' . $answers[$i] . '</dd>';
                            }
                        }
                    }
                ?>
            </dl>

            <?php comments_template( '', true ); ?>

        <?php endwhile; // end of the loop. ?>

    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
