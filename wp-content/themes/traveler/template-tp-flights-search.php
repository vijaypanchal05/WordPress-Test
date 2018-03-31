<?php
/**
 * Template Name: TraverPayout Search Result
 */

get_header();
?>
<div class="st-main-content">
    <div class="st-tp-search-result">
        <?php
        $whitelabel_name = st()->get_option('tp_whitelabel', 'whilelabel.travelerwp.com');
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
        ?>
        <script charset="utf-8" type="text/javascript" src="<?php echo ($protocol.$whitelabel_name); ?>/iframe.js"></script>
    </div>
</div>
<?php
get_footer();
?>