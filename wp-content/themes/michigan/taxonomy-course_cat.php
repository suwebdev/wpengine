<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$michigan_webnus_options = michigan_webnus_options(); ?>
<div class="clearfix">
    <section id="headline"><div class="container"><h2>
    <?php
    if ( is_search() ) {
        echo sprintf( esc_html__( 'Search Results: &ldquo;%s&rdquo;', 'michigan' ), get_search_query() );
    if ( get_query_var( 'paged' ) ) {
        echo sprintf( esc_html__( '&nbsp;&ndash; Page %s', 'michigan' ), get_query_var( 'paged' ) ); }
    } elseif ( is_tax() ) {
        echo single_term_title( '', false );
    }else{
        echo esc_html__('All Courses','michigan');
    }
    ?>
    </h2></div></section>
    <main class="container content w-course-archive" role="main">
        <hr class="vertical-space">
        <aside class="col-md-3">
            <div class="filter-category">
                <h3> <?php esc_html_e('FILTER CATEGORIES','michigan'); ?> </h3>
                <?php the_widget ('Michigan_Course_Categories', 'post_counts=true&category_icon=true'); ?>
            </div>
            <hr class="vertical-space">
        </aside>
        <div id="page- <?php the_ID(); ?>"<?php post_class('col-md-9'); ?>>
            <div class="btn-group row">
                <div class="col-md-10 col-sm-10 courses-search">
                    <?php the_widget('Michigan_Search_Course','category_field=true&instructor_field=true'); ?>
                </div>
                <div class="col-md-2 col-sm-2 alignright">
                    <a href="#" id="list" class="btn btn-default btn-sm">
                    <i class="fa-th-list"></i>
                    </a>
                    <a href="#" id="grid" class="btn btn-default btn-sm active">
                    <i class="fa-th-large"></i>
                    </a>
                </div>
            </div>
            <hr class="vertical-space">
        <?php
        do_action( 'lifterlms_archive_description' );
        if ( have_posts() ){
            echo '<div class="w-courses course-grid-t modern-grid"><div class="courses">';
            $rcount=1;
            $row=3;
            while ( have_posts() ) :the_post();
            global $post;
            global $wpdb;
            $students = $wpdb->get_results($wpdb->prepare(
                'SELECT
                user_id,
                meta_value,
                post_id
                FROM '.$wpdb->prefix . 'lifterlms_user_postmeta
                WHERE meta_key = "_status"
                AND meta_value = "Enrolled"
                AND post_id = %d
                AND EXISTS(SELECT 1 FROM ' . $wpdb->prefix . 'users WHERE ID = user_id)
                group by user_id'
            ,$post->ID));
            $course_students = rwmb_meta( 'michigan_course_students_meta' ) ? rwmb_meta( 'michigan_course_students_meta' ):count($students);
            $classes = array();
            global $course;
            $post_id = get_the_ID();
            $lms_lenght = (class_exists('LLMS_Product'))? get_post_meta( $post_id, '_llms_length', true ) :'';
            $custom_lenght = rwmb_meta('michigan_course_duration_meta');
            $course_duration = ($custom_lenght)?$custom_lenght:$lms_lenght;
            echo ($rcount == 1)?'<div class="row">':''; ?>
            <div class="col-md-4 course-list-col">
                <article class="w-course-list">
                    <div class="clearfix">
                    <div class="col-md-4 course-list-border-right">
                        <?php
                            if (get_the_terms($post->ID, 'course_cat' )) {
                                echo '<div class="modern-cat">';
                                $categories = get_the_terms($post->ID, 'course_cat' );
                                $typeName = array();
                                foreach ( $categories as $category ) :
                                    if(function_exists('tax_icons_output_term_icon')){
                                        $cat_icon =  tax_icons_output_term_icon( $category->term_id );
                                    }else{
                                        $cat_icon = '';
                                    }

                                    $typeName[] = '<a class="hcolorf" href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all courses under %s', 'michigan' ), $category->name ) ) . '">'. $cat_icon . esc_html( $category->name ). '</a>';

                                endforeach;
                                echo implode(', ', $typeName);
                                echo '</div>';
                            }

                        global $post; ?>
                        <figure><a class="" href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail( $post->ID ) ) {
                            $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'michigan_webnus_blog2_img' );
                            echo '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />';
                        } else{
                            $no_img = get_template_directory_uri().'/images/course_no_image.png';?>
                            <?php echo '<img src="' . $no_img . '" alt="Placeholder" class="llms-course-image llms-placeholder wp-post-image" />';
                        } ?>
                        </a></figure>
                        <?php
                        echo($course_duration)?'<span class="modern-duration">'.$course_duration.'<i class="fa-clock-o"></i></span>':'';
                        ?>
                    </div>
                    <div class="col-md-8 none-grid">
                        <div class="course-list-content">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <?php
                    $content ='<p>'.michigan_webnus_excerpt(36).'</p>';
                    echo '<div class="course-list-price">';
                    course_price();
                    echo'</div>';
                    echo $content;
                    if($michigan_webnus_options['michigan_webnus_course_taking']==1 && is_plugin_active('lifterlms/lifterlms.php')){
                        llms_get_template( 'course/purchase-link.php' );
                    }elseif($michigan_webnus_options['michigan_webnus_course_taking']==2){
                        echo '<br><a href="'.$michigan_webnus_options['michigan_webnus_course_taking_custom'].'" class="llms-button" target="_self">'.esc_html__('Take This Course','michigan').'</a>';
                    }?>
                        </div>
                    </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-md-4 course-list-border-right">
                            <div class="course-list-review">
                                <div class="modern-content">
                                    <h3 class="llms-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php
                                    if(function_exists('the_ratings')) {
                                        echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Votes','michigan').')</strong></div>', get_the_ID());
                                    }
                                    global $post;
                                    echo '<div class="llms-price-wrapper"><h4 class="llms-price"><span>';
                                    course_price();
                                    echo'</span></h4></div>';
                                    ?>
                                    <div class="clearfix modern-meta">
                                        <?php
                                        $my_post = get_post( $post->ID );
                                        $author_id = $my_post->post_author;
                                        $instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 );
                                        $instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'.$instructor_avatar .get_the_author_meta( 'display_name',$author_id ).'</a>';
                                        echo  '<div class="col-md-8 col-sm-8 col-xs-8"><div class="modern-instructor">'.$instructor_title.'</div></div>';
                                        echo '<div class="col-md-4 col-sm-4 col-xs-4">';
                                        echo ($course_students)?'<span class="modern-students" title="'.esc_attr('Enrolled Students','michigan').'"><i class="sl-people"></i>'.$course_students.'</span>':'<span class="modern-viewers" title="'.esc_attr('Viewers','michigan').'"><i class="fa-eye"></i>'.michigan_webnus_getViews(get_the_ID()).'</span>';
                                        echo '</div>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 nopad-all none-grid">
                            <div class="course-list-meta">
                                <div class="clearfix">
                                <?php
                                echo ($course_duration)?'<div class="col-md-2 col-sm-2 col-xs-6"><span class="course-list-duration"><i class="sl-clock"></i>'.$course_duration.'</span></div>':'';
                                $my_post = get_post( $post->ID );
                                $author_id = $my_post->post_author;
                                $instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name',$author_id ).'</a>';
                                echo '<div class="col-md-4 col-sm-4 col-xs-6 nopad-all"><span class="course-list-instructor"><i class="sl-user"></i>'.$instructor_title.'</span></div>';
                                echo ($course_students)?'<div class="col-md-3 col-sm-3 col-xs-6 nopad-all"><span class="course-list-students"><i class="sl-people"></i>'.$course_students .' '. esc_html__('Studesnts','michigan').'</span></div>':'';
                                echo '<div class="col-md-3 col-sm-3 col-xs-6 nopad-all"><span class="modern-viewers"><i class="sl-eyeglass"></i>'.michigan_webnus_getViews(get_the_ID()) .' '. esc_html__('Viewers','michigan').'</span></div>';
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <?php if($rcount == $row){
            echo '</div>';
            $rcount = 0;
            }
            $rcount++;
            endwhile;
            echo '</div></div>';
        }else{
            echo '<p class="lifterlms-info">'._e( 'No products were found matching your selection.', 'michigan' ) .'</p>';
        }
        if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
            echo '<div class="wp-pagenavi">';
            next_posts_link(esc_html__('&larr; Previous page', 'michigan'));
            previous_posts_link(esc_html__('Next page &rarr;', 'michigan'));
            echo '</div>';
        } ?>
        </div>
    </main>
</div>
<?php do_action( 'lifterlms_sidebar' ); ?>
<?php get_footer(); ?>