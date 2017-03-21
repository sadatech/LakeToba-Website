<?php
class cn_pf_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cn_pf_widget',


            __('CN Portfolio Widget', 'cn_pf_widget_domain'),


            array( 'description' => __( 'Codenovo Portfolio Widget', 'cn_pf_widget_domain' ), )
        );
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $details = apply_filters( 'widget_details', $instance['details'] );
        $category = apply_filters( 'widget_category', $instance['category'] );
        $itemnum = apply_filters( 'widget_itemnum', $instance['itemnum'] );
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        if ( ! empty( $details ) )
            echo '<p>'.$details.'</p>';
        if($category == -1){
            $loop = new WP_Query(
                array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => $itemnum,
                )
            );
        }
        else{
            $loop = new WP_Query(
                array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => $itemnum,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'portfoliocategory',
                            'field' => 'name',
                            'terms' => array( $category )
                        )
                    )
                )
            );
        }
        $output = '<div class="cn_pf_widget_content"><div id="cn_pf_widget">';
        if ( $loop ) :
            while ( $loop->have_posts() ) :
                $loop->the_post();
                $portfolio_url = get_post_custom_values('_url');
                if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $portfolio_url[0])) {
                    $purl = parse_url($portfolio_url[0]);
                    if(!isset($purl['scheme'])){
                        $purl = 'http://'.$portfolio_url[0];
                    }
                    else{
                        $purl = $portfolio_url[0];
                    }
                }
                else{
                    $purl = $portfolio_url[0];
                }

                $output .=  '<div class="cn-single-portfolio">';
                $url = wp_get_attachment_url( get_post_thumbnail_id() );
                if(!empty($portfolio_url[0])){
                    $output .= '<a href="'.$purl.'" class="cnprotfolio-img" target="_blank">';
                }
                else{
                    $output .= '<a href="javascript:void(0)" class="cnprotfolio-img">';
                }
                $output .= '<img src="'.$url.'" alt="'.get_the_title().'" />';
                $output .= '</a></div>';
            endwhile;
        endif;
        $output .= "</div></div>";
        echo $output;
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        if ($instance) {
            $title = $instance[ 'title' ];
            $category = esc_attr($instance[ 'category' ]);
            $itemnum = esc_attr($instance[ 'itemnum' ]);
            $details = esc_textarea($instance[ 'details' ]);
        }
        else {
            $title = __( 'New title', 'cn_pf_widget_domain' );
            $category = __( 'New category', 'cn_pf_widget_domain' );
            $itemnum = __( '5', 'cn_pf_widget_domain' );
            $details = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'details' ); ?>" name="<?php echo $this->get_field_name( 'details' ); ?>"><?php echo esc_attr( $details ); ?></textarea>
        <?php
        $terms = get_terms("portfoliocategory");
        $item = count($terms);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
                <option value="-1" >All</option>
            <?php
            if ( $item > 0 ){
            ?>
            <?php
                foreach ( $terms as $term ) {
            ?>
                <option value="<?php echo $term->name ?>" <?php if(esc_attr( $category ) == $term->name) echo "selected" ?>><?php echo $term->name ?></option>
            <?php
                }
            }
            ?>
            </select>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'itemnum' ); ?>"><?php _e( 'Item Number:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'itemnum' ); ?>" name="<?php echo $this->get_field_name( 'itemnum' ); ?>" type="text" value="<?php echo esc_attr( $itemnum ); ?>" />
        </p>
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['details'] = ( ! empty( $new_instance['details'] ) ) ? $new_instance['details'] : '';
        $instance['category'] = ( ! empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';
        $instance['itemnum'] = ( ! empty( $new_instance['itemnum'] ) ) ? strip_tags( $new_instance['itemnum'] ) : '';
        return $instance;
    }
}

function cn_pf_load_widget() {
    register_widget( 'cn_pf_widget' );
}
add_action( 'widgets_init', 'cn_pf_load_widget' );
