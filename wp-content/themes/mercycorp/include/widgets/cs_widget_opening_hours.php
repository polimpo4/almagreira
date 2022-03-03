<?php
/*
 * Widget Name: "CS: Opening Hours"
 */

class cs_widget_opening_hours extends WP_Widget {

    public function __construct() {

        parent::__construct(
                'cs_widget_opening_hours', // Base ID
                __('CS: Opening Hours', 'Mercycorp'), // Name
                array('classname' => 'cs_widget_opening_hours', 'description' => 'Display Opening Hours for visitors in Widget Area.',) // Args
        );
    }

    // Displays Form on the WPAdmin side in main page for Widgets Arrangements/Settings.
    function form($instance) {
        //parent::form($instance);

        $instance = wp_parse_args((array) $instance, array('title' => 'Opening Hours', 'monday' => '9.00 - 17.00', 'tuesday' => '9.00 - 17.00', 'wednesday' => '9.00 - 17.00', 'thursday' => '9.00 - 17.00', 'friday' => '9.00 - 17.00', 'saturday' => '9.30 - 15.30', 'sunday' => '12.00 - 16.00'));
        $title = $instance['title'];
        $monday = $instance['monday'];
        $tuesday = $instance['tuesday'];
        $wednesday = $instance['wednesday'];
        $thursday = $instance['thursday'];
        $friday = $instance['friday'];
        $saturday = $instance['saturday'];
        $sunday = $instance['sunday'];
        $get_post_slug = isset($instance['get_post_slug']) ? esc_attr($instance['get_post_slug']) : '';
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                Title: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('monday'); ?>">
                Monday Timings: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('monday'); ?>" size="40" name="<?php echo $this->get_field_name('monday'); ?>" type="text" value="<?php echo esc_attr($monday); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('tuesday'); ?>">
                Tuesday Timings: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('tuesday'); ?>" size="40" name="<?php echo $this->get_field_name('tuesday'); ?>" type="text" value="<?php echo esc_attr($tuesday); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('wednesday'); ?>">
                Wednesday Timings: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('wednesday'); ?>" size="40" name="<?php echo $this->get_field_name('wednesday'); ?>" type="text" value="<?php echo esc_attr($wednesday); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('thursday'); ?>">
                Thursday Timings: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('thursday'); ?>" size="40" name="<?php echo $this->get_field_name('thursday'); ?>" type="text" value="<?php echo esc_attr($thursday); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('friday'); ?>">
                Friday Timings: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('friday'); ?>" size="40" name="<?php echo $this->get_field_name('friday'); ?>" type="text" value="<?php echo esc_attr($friday); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('saturday'); ?>">
                Saturday Timings: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('saturday'); ?>" size="40" name="<?php echo $this->get_field_name('saturday'); ?>" type="text" value="<?php echo esc_attr($saturday); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('sunday'); ?>">
                Sunday Timings: 
                <br />
                <input class="widefat" id="<?php echo $this->get_field_id('sunday'); ?>" size="40" name="<?php echo $this->get_field_name('sunday'); ?>" type="text" value="<?php echo esc_attr($sunday); ?>" />
            </label>
        </p>

        <?php
    }

    function update($new_instance, $old_instance) {
        //parent::update($new_instance, $old_instance);
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['monday'] = $new_instance['monday'];
        $instance['tuesday'] = $new_instance['tuesday'];
        $instance['wednesday'] = $new_instance['wednesday'];
        $instance['thursday'] = $new_instance['thursday'];
        $instance['friday'] = $new_instance['friday'];
        $instance['saturday'] = $new_instance['saturday'];
        $instance['sunday'] = $new_instance['sunday'];
        //$instance['img_url'] = $new_instance['img_url'];
        $instance['get_post_slug'] = $new_instance['get_post_slug'];
        return $instance;
    }

    // Displays Widget on the Frontend to visitors 
    function widget($args, $instance) {
        //parent::widget($args, $instance);
        extract($args, EXTR_SKIP);

        $instance = wp_parse_args((array) $instance, array('appnt_fname' => 'Full Name', 'appnt_email' => 'Email Address', 'appnt_phone' => 'Phone Number', 'appnt_date' => '01/dd/yyyy'));

        global $post;

        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $monday = empty($instance['monday']) ? ' ' : $instance['monday'];
        $tuesday = empty($instance['tuesday']) ? ' ' : $instance['tuesday'];
        $wednesday = empty($instance['wednesday']) ? ' ' : $instance['wednesday'];
        $thursday = empty($instance['thursday']) ? ' ' : $instance['thursday'];
        $friday = empty($instance['friday']) ? ' ' : $instance['friday'];
        $saturday = empty($instance['saturday']) ? ' ' : $instance['saturday'];
        $sunday = empty($instance['sunday']) ? ' ' : $instance['sunday'];

        echo $before_widget; // WIDGET display CODE Starts
        $get_post_slug = isset($instance['get_post_slug']) ? esc_attr($instance['get_post_slug']) : '';
        ?>
        <!-- Appointment Section Start-->
        <div id="cs-appointment">
            <h2 class="title"><?php echo substr($title, 0, 20); /* strlength -> check */ if (strlen($title) > 20) echo "..."; ?></h2>
            <p><?php /* if(strlen($description) > 75) { echo substr($description, 0, 75) . " ...";} else echo $description; /*We are Wow quizzical mightily within quetzal one wow python via salmon */ ?></p>
            <form action="" method="post">
                <ul>
                    <li><span class="day-name">Mondays</span><span class="day-timings" style="margin-left: 7em;"><?php echo esc_attr($monday); ?></span></li>
                    <li><span class="day-name">Tuesdays</span><span class="day-timings" style="margin-left: 7em;"><?php echo esc_attr($tuesday); ?></span></li>
                    <li><span class="day-name">Wednesdays</span><span class="day-timings" style="margin-left: 7em;"><?php echo esc_attr($wednesday); ?></span></li>
                    <li><span class="day-name">Thursdays</span><span class="day-timings" style="margin-left: 7em;"><?php echo esc_attr($thursday); ?></span></li>
                    <li><span class="day-name">Fridays</span><span class="day-timings" style="margin-left: 7em;"><?php echo esc_attr($friday); ?></span></li>
                    <li><span class="day-name">Saturdays</span><span class="day-timings" style="margin-left: 7em;"><?php echo esc_attr($saturday); ?></span></li>
                    <li><span class="day-name">Sundays</span><span class="day-timings" style="margin-left: 7em;"><?php echo esc_attr($sunday); ?></span></li>
                     
                </ul>
            </form><!-- Appointment Booking Form - END -->
        </div>
        <!-- Appointment Section Close-->
        <?php
        echo $after_widget; // WIDGET display CODE Ends
    }

}

add_action('widgets_init', create_function('', 'return register_widget("cs_widget_opening_hours");'));
?>