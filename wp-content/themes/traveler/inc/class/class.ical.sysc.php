<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/18/2017
 * Time: 4:29 PM
 */
if (!class_exists('ST_Ical_Sysc')) {
    class ST_Ical_Sysc extends TravelerObject
    {
        public function __construct()
        {
            add_action('wp_ajax_st_import_ical', [$this, 'st_import_ical']);
            add_action('wp_ajax_st_import_ical_other', [$this, 'st_import_ical_other']);
        }
        public function st_import_ical()
        {
            $url = esc_url(STInput::post('url', ''));
            $post_id = (int)STInput::post('post_id', '');
            $post_type = get_post_type($post_id);


            if (!empty($url) && in_array($post_type, ['hotel_room', 'st_rental', 'st_tours', 'st_activity'])) {
                $ical = new ICal($url);
                if (!empty($ical)) {

                    $events = $ical->events();
                    if (!empty($events) && is_array($events)) {
                        foreach ($events as $key => $event) {
                            $sumary = explode('|', $event['SUMMARY']);
                            $price = 0;
                            $available = 'available';
                            if ($post_type == 'hotel_room' || $post_type == 'st_rental') {
                                if ($sumary[0] == 'Not available' || $sumary[0] == 'Blocked' || !is_numeric($sumary[0])) {
                                    $available = 'unavailable';
                                } else {
                                    $price = (float)$sumary[0];
                                    if ($price < 0) {
                                        $price = 0;
                                    }
                                }
                                if (isset($sumary[1]) && !empty($sumary[1]) && strtolower($sumary[1]) == 'unavailable') {
                                    $available = 'unavailable';
                                }
                                if (isset($event['DTSTART']) && isset($event['DTEND'])) {
                                    if (strlen($event['DTSTART']) > 8) {
                                        $event['DTSTART'] = substr($event['DTSTART'], 0, 8);
                                    }
                                    if (strlen($event['DTEND']) > 8) {
                                        $event['DTEND'] = substr($event['DTEND'], 0, 8);
                                    }
                                    $start = DateTime::createFromFormat('Ymd', $event['DTSTART']);
                                    $start = strtotime($start->format('Y-m-d'));
                                    $end = DateTime::createFromFormat('Ymd', $event['DTEND']);
                                    $end = strtotime($end->format('Y-m-d'));
                                    $end = strtotime('-1 day', $end);
                                    $this->import_event($post_id, $post_type, $price, $start, $end, $available);
                                }


                            } elseif ($post_type == 'st_tours' || $post_type == 'st_activity') {
                                if ($sumary[0] == 'Not available' || $sumary[0] == 'Blocked' || !is_numeric($sumary[0])) {
                                    $available = 'unavailable';
                                }
                                $adult_price = $child_price = $infant_price = 0;
                                $group_day = 0;
                                $adult_price = (float)$sumary[0];
                                if (isset($sumary[1])) {
                                    $child_price = (float)$sumary[1];
                                }
                                if (isset($sumary[2])) {
                                    $infant_price = (float)$sumary[2];
                                }
                                if (isset($sumary[3]) && !empty($sumary[3]) && strtolower($sumary[3]) == 'unavailable') {
                                    $available = 'unavailable';
                                }
                                if (isset($sumary[4]) && (int)$sumary[4] > 0) {
                                    $group_day = 1;
                                }
                                if (isset($event['DTSTART']) && isset($event['DTEND'])) {
                                    if (strlen($event['DTSTART']) > 8) {
                                        $event['DTSTART'] = substr($event['DTSTART'], 0, 8);
                                    }
                                    if (strlen($event['DTEND']) > 8) {
                                        $event['DTEND'] = substr($event['DTEND'], 0, 8);
                                    }
                                    $start = DateTime::createFromFormat('Ymd', $event['DTSTART']);
                                    $start = strtotime($start->format('Y-m-d'));
                                    $end = DateTime::createFromFormat('Ymd', $event['DTEND']);
                                    $end = strtotime($end->format('Y-m-d'));
                                    $end = strtotime('-1 day', $end);
                                    $this->import_event_tour($post_id, $post_type, $adult_price, $child_price, $infant_price, $group_day, $start, $end, $available);
                                }
                            }

                        }
                    }
                }
            }
            update_post_meta($post_id, 'sys_created', current_time('timestamp', 1));
            update_post_meta($post_id, 'ical_url', $url);
            echo json_encode([
                'status' => 1,
                'message' => '<p class="text-success">' . __('Successful', ST_TEXTDOMAIN) . '</p>'
            ]);
            die;
        }

        private
        function import_event($post_id, $post_type, $price, $start, $end, $available)
        {
            global $wpdb;
            $sql = "SELECT
                    count(id)
                FROM
                    {$wpdb->prefix}st_availability
                WHERE
                    post_id = {$post_id}
                AND (
                    (
                        {$start} BETWEEN check_in
                        AND check_out
                    )
                    OR (
                        {$end} BETWEEN check_in
                        AND check_out
                    )
                )";

            $count = (int)$wpdb->get_var($sql);
            //if ( $count == 0 ) {
            $string = '';
            for ($i = (int)$start; $i <= (int)$end; $i = strtotime('+1 day', $i)) {
                $string .= $wpdb->prepare("(null, %s, %s,%s, %s, %s, %s),", $post_id, $post_type, $i, $i, $price, $available);
            }
            if (!empty($string)) {
                $string = substr($string, 0, -1);
                $sql = "INSERT INTO {$wpdb->prefix}st_availability (id, post_id, post_type,check_in,check_out,price, status) VALUES {$string}";
                $wpdb->query($sql);
            }
            //}
        }

        private
        function import_event_tour($post_id, $post_type, $adult_price, $child_price, $infant_price, $group_day, $start, $end, $available)
        {
            global $wpdb;
            $sql = "SELECT
                    count(id)
                FROM
                    {$wpdb->prefix}st_availability
                WHERE
                    post_id = {$post_id}
                AND (
                    (
                        {$start} BETWEEN check_in
                        AND check_out
                    )
                    OR (
                        {$end} BETWEEN check_in
                        AND check_out
                    )
                )";

            $count = (int)$wpdb->get_var($sql);
            if ($count == 0) {
                $string = '';
                for ($i = (int)$start; $i <= (int)$end; $i = strtotime('+1 day', $i)) {
                    $string .= $wpdb->prepare("(null, %s, %s, %s, %s, %s, %s, %s, %d, %s),", $post_id, $post_type, $i, $i, $adult_price, $child_price, $infant_price, $group_day, $available);
                }
                if (!empty($string)) {
                    $string = substr($string, 0, -1);
                    $sql = "INSERT INTO {$wpdb->prefix}st_availability (id, post_id, post_type,check_in,check_out,adult_price,child_price,infant_price, groupday, status) VALUES {$string}";
                    $wpdb->query($sql);
                }
            }
        }
    }

    new ST_Ical_Sysc();
}