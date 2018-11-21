<?php
/**
 * Plugin Name: Feedback | Frank Galos
 * Author:<a href="//frankgalos.herokuapp.com" target="_blank">Frank Galos</a>
 * Email:frankslayer1@gmail.com
 * Description: This plugin is for displaying user feedback for darceramica.co.tz!
 * @license: Apache License 2.0
 * @link: https://github.com/reddeath1/wp-feedback
 * @package: wp-feedback
 */


header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$url = $_SERVER['SERVER_NAME'];
$url = (preg_match('/localhost/',$url)) ? 'electrician' : '';

include_once($_SERVER['DOCUMENT_ROOT']."/$url/wp-config.php" );

global $wpdb;
$wpdb->show_errors();

function fb_add_menu(){

    add_menu_page( 'DCC Feedback',
        'Feedback',
        'manage_options',
        'feedback',
        'fb_setup',
        plugins_url('/images/logo.png',__FILE__)
    );
}

function fb_styles(){
    // Register the style like this for a plugin:
    wp_register_style( 'bootstrap', "//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css", array(), '20120208', 'all' );

    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'bootstrap' );
    // Register the style like this for a plugin:
    wp_register_style( 'feedback-style', plugins_url( '/css/style.css', __FILE__ ), array(), '20120208', 'all' );

    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'feedback-style' );
}

function fb_scripts(){
    // Register the script like this for a plugin:
    wp_register_script( 'bootstrap',"//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js",array() );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'bootstrap' );
    // Register the script like this for a plugin:
    wp_register_script( 'feedback-script', plugins_url( '/js/js.js', __FILE__ ),array( 'jquery') );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'feedback-script' );
}

function add_fb_shortcode(){

    $plugin_url = plugins_url().'/feedback';

    $feed = get_feed_back(true);

    $data = "$feed
    
    
    <script>var user = {url:'$plugin_url'}</script>
    " ;

    return $data;
}

add_shortcode('wp_feedback','add_fb_shortcode');

function form(){
    return "
    <div class=\"wpforms-container wpforms-container-full\" id=\"wpforms-6296\">
    <form id=\"wpforms-form-6296\" class=\"wpforms-validate wpforms-form\" data-formid=\"6296\" method=\"post\" enctype=\"multipart/form-data\" action=\"/contact/feedback/\" novalidate=\"novalidate\">
    <div class=\"wpforms-field-container\"><div id=\"wpforms-6296-field_0-container\" class=\"wpforms-field wpforms-field-name\" data-field-id=\"0\">
    <label class=\"wpforms-field-label\" for=\"wpforms-6296-field_0\">Name <span class=\"wpforms-required-label\">*</span></label>
    <div class=\"wpforms-field-row wpforms-field-medium\">
    <div class=\"wpforms-field-row-block wpforms-first wpforms-one-half\">
    <input type=\"text\" id=\"wpforms-6296-field_0\" class=\"wpforms-field-name-first wpforms-field-required\" name=\"wpforms[fields][0][first]\" required=\"\" aria-required=\"true\">
    <label for=\"wpforms-6296-field_0\" class=\"wpforms-field-sublabel after \">First</label></div>
    <div class=\"wpforms-field-row-block wpforms-one-half\">
    <input type=\"text\" id=\"wpforms-6296-field_0-last\" class=\"wpforms-field-name-last wpforms-field-required\" name=\"wpforms[fields][0][last]\" required=\"\" aria-required=\"true\">
    <label for=\"wpforms-6296-field_0-last\" class=\"wpforms-field-sublabel after \">Last</label></div></div></div><div id=\"wpforms-6296-field_1-container\" class=\"wpforms-field wpforms-field-email\" data-field-id=\"1\">
    <label class=\"wpforms-field-label\" for=\"wpforms-6296-field_1\">Email <span class=\"wpforms-required-label\">*</span></label>
    <input type=\"email\" id=\"wpforms-6296-field_1\" class=\"wpforms-field-medium wpforms-field-required\" name=\"wpforms[fields][1]\" required=\"\" aria-required=\"true\">
    <div class=\"wpforms-field-description\">Please enter your email, so we can follow up with you.</div>
    </div>
    <div id=\"wpforms-6296-field_5-container\" class=\"wpforms-field wpforms-field-number\" data-field-id=\"5\"><label class=\"wpforms-field-label\" for=\"wpforms-6296-field_5\">Phone <span class=\"wpforms-required-label\">*</span></label>
    <input type=\"number\" id=\"wpforms-6296-field_5\" class=\"wpforms-field-medium wpforms-field-required\" name=\"wpforms[fields][5]\" required=\"\" aria-required=\"true\">
    <div class=\"wpforms-field-description\">Please enter your phone number , so we can follow up with you quickly.</div>
    </div>
    <div id=\"wpforms-6296-field_2-container\" class=\"wpforms-field wpforms-field-radio\" data-field-id=\"2\">
    <label class=\"wpforms-field-label\" for=\"wpforms-6296-field_2\">Which department do you have a feedback for? <span class=\"wpforms-required-label\">*</span></label>
    <ul id=\"wpforms-6296-field_2\" class=\"wpforms-field-required\">
    <li class=\"choice-1 depth-1\">
    <input type=\"radio\" id=\"wpforms-6296-field_2_1\" name=\"wpforms[fields][2]\" value=\"Sales\" required=\"\" aria-required=\"true\">
    <label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_2_1\">Sales</label></li><li class=\"choice-2 depth-1\">
    <input type=\"radio\" id=\"wpforms-6296-field_2_2\" name=\"wpforms[fields][2]\" value=\"Customer Support\" required=\"\" aria-required=\"true\">
    <label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_2_2\">Customer Support</label></li>
    <li class=\"choice-3 depth-1\">
    <input type=\"radio\" id=\"wpforms-6296-field_2_3\" name=\"wpforms[fields][2]\" value=\"Product Development\" required=\"\" aria-required=\"true\">
    <label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_2_3\">Product Development</label></li><li class=\"choice-4 depth-1\">
    <input type=\"radio\" id=\"wpforms-6296-field_2_4\" name=\"wpforms[fields][2]\" value=\"Other\" required=\"\" aria-required=\"true\">
    <label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_2_4\">Other</label></li>
    </ul>
    </div>
    <label class=\"wpforms-field-label\" for=\"wpforms-6296-field_9\">Showroom <span class=\"wpforms-required-label\">*</span></label><ul id=\"wpforms-6296-field_9\" class=\"wpforms-randomize wpforms-field-required\"><li class=\"choice-7 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_7\" name=\"wpforms[fields][9]\" value=\"INDIA STREET\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_7\">INDIA STREET</label></li><li class=\"choice-9 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_9\" name=\"wpforms[fields][9]\" value=\"MBEYA\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_9\">MBEYA</label></li><li class=\"choice-10 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_10\" name=\"wpforms[fields][9]\" value=\"DODOMA\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_10\">DODOMA</label></li><li class=\"choice-11 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_11\" name=\"wpforms[fields][9]\" value=\"MOSHI\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_11\">MOSHI</label></li><li class=\"choice-13 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_13\" name=\"wpforms[fields][9]\" value=\"ARUSHA\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_13\">ARUSHA</label></li><li class=\"choice-5 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_5\" name=\"wpforms[fields][9]\" value=\"MIKOCHENI\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_5\">MIKOCHENI</label></li><li class=\"choice-2 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_2\" name=\"wpforms[fields][9]\" value=\"KARIAKOO\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_2\">KARIAKOO</label></li><li class=\"choice-8 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_8\" name=\"wpforms[fields][9]\" value=\"MWANZA\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_8\">MWANZA</label></li><li class=\"choice-6 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_6\" name=\"wpforms[fields][9]\" value=\"MBEZI\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_6\">MBEZI</label></li><li class=\"choice-3 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_3\" name=\"wpforms[fields][9]\" value=\"NASRA TOWER\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_3\">NASRA TOWER</label></li><li class=\"choice-4 depth-1\"><input type=\"radio\" id=\"wpforms-6296-field_9_4\" name=\"wpforms[fields][9]\" value=\"KAWE\" required=\"\" aria-required=\"true\"><label class=\"wpforms-field-label-inline\" for=\"wpforms-6296-field_9_4\">KAWE</label></li></ul><div class=\"wpforms-field-description\">Where did this happen?</div>
    <div id=\"wpforms-6296-field_4-container\" class=\"wpforms-field wpforms-field-textarea\" data-field-id=\"4\">
    <label class=\"wpforms-field-label\" for=\"wpforms-6296-field_4\">Your Feedback <span class=\"wpforms-required-label\">*</span></label>
    <textarea id=\"wpforms-6296-field_4\" class=\"wpforms-field-medium wpforms-field-required\" name=\"wpforms[fields][4]\" required=\"\" aria-required=\"true\"></textarea>
    </div>
    </div>
    
    
    <div class=\"wpforms-field wpforms-field-hp\">
    <div class=\"wpforms-submit-container\">
    <button type=\"submit\" name=\"wpforms[submit]\" class=\"wpforms-submit \" id=\"wpforms-submit-6296\" value=\"wpforms-submit\" data-alt-text=\"Sending...\">Submit</button>
    </div>
    </form>
    </div>
    ";
}

add_shortcode('wp_form','form');

function db_install(){
    global $wpdb;

    $sql = $wpdb->query("CREATE TABLE IF NOT EXISTS feedback (
  id int(11) NOT NULL auto_increment,
  username varchar(25) NOT NULL,
  phone varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  department varchar(255) NOT NULL,
  feedback text  NOT NULL,
  showrooms VARCHAR(255) null ,
  feed_date DATETIME NOT NULL DEFAULT NOW() ,
  approve enum('0','1')  NOT NULL DEFAULT '0',
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

    if($sql){
        set_transient( 'fx-admin-notice', true, 5 );
    }
}

function fx_admin_notice_notice(){

    /* Check transient, if available display notice */
    if( get_transient( 'fx-admin-notice' ) ){
        ?>
        <div class="updated notice is-dismissible">
            <p>Thank you for using this plugin! <strong>You are awesome</strong>.</p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'fx-admin-notice' );
    }
}

add_action( 'admin_notices', 'fx_admin_notice_notice' );
function db_uninstall(){
    global $wpdb;
    $wpdb->query("
        DROP TABLE IF EXISTS feedback;
    ");

}

function fb_setup(){
    include_once( 'views/Home.php' );
}

function fb_install(){
    db_install();
}

function fb_uninstall(){
    //db_uninstall();
}

function count_feedback($type = false){
    global $wpdb;
    $result = '';
    $where = ($type) ? "WHERE approve = '1' ORDER BY id DESC" : " ORDER BY id DESC";


    $sql = $wpdb->get_results("SELECT count(id) as c FROM feedback $where");

    if($sql){
        foreach ($sql as $item) {
            $result = (int) $item->c;
        }

    }

    return $result;
}

function get_feed_back($type = false){
    global $wpdb;
    $result = '';
    $rows = count_feedback($type);

    $limit_page = ($type) ? 5 : 15;
    $last = ceil($rows/$limit_page);
    $page = 1;

    if($last < 1){
        $last = 1;
    }

    $controls = '';


    $where = ($type) ? "WHERE approve = '1' ORDER BY id DESC LIMIT ".($page-1) * $limit_page.", $limit_page" : " ORDER BY id DESC LIMIT ".($page-1) * $limit_page.", $limit_page";


    $sql = $wpdb->get_results("SELECT * FROM feedback $where");

    if($sql){
        $plugin_url = plugins_url().'/feedback';

        $isAdmin = current_user_can('Administrator');

        $results = "<script>var user = {url:'$plugin_url'}</script>";

        foreach ($sql as $item) {
            $id = $item->id;
            $user = ucwords($item->username);
            $pn = $item->phone;
            $em = $item->email;
            $dp = ucwords($item->department);
            $fd = $item->feedback;
            $date = $item->feed_date;
            $showrooms = $item->showrooms;
            $approve =  (int) $item->approve;
            $date = date("M d, Y",strtotime($date));


            if($type){
                $result .= "
                            <li class=\"recentcomments\">
                            <span class=\"comment-author-link\">$user</span> - 
                            <a >$fd</a></li>";
            }else{

                $status = ($approve > 0) ? 'approved' : 'pending';

                $action = "
<span class='approval $id' style='color:green'>
<i class=\"glyphicon glyphicon-ok\"></i> Approve</span>
 
";
                if($approve > 0 && !$isAdmin){
                    $action = "";
                }

                $result .= "<tr data-status=\"$status\">
                                    <td>
                                        <div class=\"ckbox\">
                                            <input type=\"checkbox\" id=\"checkbox$id\">
                                            <label for=\"checkbox$id\"></label>
                                        </div>
                                    </td>
                                        <a href=\"javascript:;\" class=\"star\">
                                    <td>
                                            <i class=\"glyphicon glyphicon-star\"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class=\"media\">
                                            <a href=\"#\" class=\"pull-left\">
                                                <img src=\"https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg\" class=\"media-photo\">
                                            </a>
                                            <div class=\"media-body\">
												
                                                <h4 class=\"title\">
                                                    $user 
                                                <span class=\"media-meta pull-right\" style='margin-left:10px;'> $date</span>

											<span class=\"pull-right $status\" style='font-size:16px;'>
                                                <span class=\"pull-left$status\">($status)</span>
                                                
<span class='reply $id' id='$user,$em' style='color:green'>
<i class=\"glyphicon glyphicon-share\"></i> Reply</span> 

                                                $action 

 <span class='delete full-left $id' style='color:brown'>
  
  <i class=\"glyphicon glyphicon-remove\"></i> Delete</span>
                                            </span>
                                                    

												
                                                </h4>
$pn 
							<span class='pull-right' style='margin-left:10px;'>
                                    $em</span>
                                                <p class=\"summary\">$dp - $showrooms</p>
                                                <p class=\"summary dep\">$fd</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
</td>
                                </tr>";
            }
        }
        if($type){
            $result = "<ul id=\"recentcomments\">
	$result
</ul>";
        }else{
            $result .= $results;
        }
    }else{
        $result = 'No records found';
        if($type){
            $result = "<ul id=\"recentcomments\">
                            <li class=\"recentcomments\">
                            $result
                            </li>
                            </ul>";
        }else{
            $result = "<tr>
                            <td>
                                $result
                            </td>
                        </tr>";
        }
    }

    if ($last != 1) {
        $cn = ($type) ? '#recentcomments':'.post-container';
        $type = ($type) ? 'home':'admin';
        $controls = '';
        if ($page > 1) {
            $controls = "<button class='btn btn-block btn-round' onclick=\"pageNation(".($page -1).",$last,$limit_page,'$cn','$type');\">&lt;</button>";
        }

        $controls .= "&nbsp;&nbsp; <b class='page-count-status'> Page $page of $last </b> &nbsp;&nbsp;";

        if ($page != $last) {

            $controls .= "<button class='btn btn-block btn-round' onclick=\"pageNation(".($page+1).",$last,$limit_page,'$cn','$type');\">&gt;</button>";
        }

        $controls ="<div id=\"page-controller\">$controls</div>";
    }

    return $result.$controls;
}

add_action( 'admin_menu', 'fb_add_menu' );
add_action( 'admin_enqueue_scripts', 'fb_styles');
add_action( 'wp_enqueue_scripts', 'fb_scripts');
register_activation_hook( __FILE__, 'fb_install' );
register_deactivation_hook( __FILE__, 'fb_uninstall' );