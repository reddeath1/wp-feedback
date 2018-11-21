<?php
/**
 * Created by PhpStorm.
 * User: reddeath
 * Date: 11/8/2018
 * Time: 9:46 PM
 */
$url = $_SERVER['SERVER_NAME'];
$url = (preg_match('/localhost/',$url)) ? 'electrician' : '';

include_once($_SERVER['DOCUMENT_ROOT']."/$url/wp-config.php" );

global $wpdb;
//$wpdb->show_errors();

class Ajax{

    private $db;
    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->processor();
    }

    private function processor(){
        if(isset($_POST['action']) && !empty($_POST['action']) ||
            isset($_GET['action']) && !empty($_GET['action'])){

            $ac = ($this->get_requested_method() === "POST") ?
                $_POST['action'] : $_GET['action'];

            if(method_exists($this,$ac)){
                $this->$ac();
            }else{
                $this->error('Error bad request',0);
            }

        }else{
            $this->error('Error bad request',0);
        }
    }

    public function dofeedback(){

        if(!empty($_POST['fn'])
            && !empty($_POST['ln'])
            && !empty($_POST['em'])
            && !empty($_POST['pn'])
            && !empty($_POST['dp'])
            && !empty($_POST['fd'])){

            $fn = sanitize_user($_POST['fn']);
            $ln = sanitize_user($_POST['ln']);
            $pn = sanitize_text_field($_POST['pn']);
            $em = sanitize_email($_POST['em']);
            $s = sanitize_text_field($_POST['s']);
            $dp = sanitize_text_field($_POST['dp']);
            $fd = sanitize_textarea_field($_POST['fd']);
            $d = date("Y-m-d H:i:s");
            $d = date("Y-m-d H:i:s",strtotime($d));

            $sql = $this->db->insert('feedback',array(
                'username'=>$fn.' '.$ln,
                'phone'=>$pn,
                'email'=>$em,
                'showrooms'=>$s,
                'department'=>$dp,
                'feedback'=>$fd));

            if($sql){
                $this->success(
                    '<h3 style="color:green;text-align: center;">Conglaturation</h3>
                            <p style="text-align: center;">Your feedback is successful submitted.<br> We will review and revert back.
                            <br>Thank you!</p>');
            }else{
                $this->error("Sorry something went wrong please try again. <br>If problem persists contact us. ");
            }

        }else{
            $this->error('All fields are required!');
        }
    }

    public function approve_feedback(){
        if(!empty($_POST['id'])){
            $id = $_POST['id'];

            $sql =  $this->db->update( 'feedback', array('approve'=>'1'),
                array('id'=>$id));

            if($sql){
                $this->success("Feedback was successful approved!");
            }else{
                $this->error('Sorry something went wrong Please try again!');
            }
        }else{
            $this->error('Sorry something went wrong Please try again!');
        }
    }

    public function delete_feedback(){
        if(!empty($_POST['id'])){
            $id = $_POST['id'];

            $sql =  $this->db->delete( 'feedback', array('id'=>$id));

            if($sql){
                $this->success("Feedback was successful deleted!");
            }else{
                $this->error('Sorry something went wrong Please try again!');
            }
        }else{
            $this->error('Sorry something went wrong Please try again!');
        }
    }

    public function reply_feedback(){
        if(!empty($_POST['id'])){
            $id = $_POST['id'];
            $rep = htmlentities($_POST['rep']);
            $user = preg_replace('#[^a-z0-9- ]#i','',$_POST['u']);
            $email = htmlentities($_POST['e']);


            $to = $email;
            $from = "info@darceramica";
            $subject = "RE: Darceramica Support";
            $headers = "From: ".$from."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $message = "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Darceramica message</title></head><body style='margin:0px; font-family:Tahoma, Geneva, sans-serif;'><div style='padding:10px; background:#BA5370;background:linear-gradient(to right,#BA5370,#BA5370); font-size:24px; color:#fff; width: 100%;height: auto;display: inline-block;'><a href='".$this->link."'><img src='http://darceramica.co.tz/wp-content/uploads/2017/08/Dar-Ceramica_logo.png' alt='darceramica' style='border:none; width:auto;height:90px; display:inline-block; float:left;'></a><br> Darceramica Support</div><div style='padding:24px; font-size:17px;'><b style='color: #BA5370;'>Hello [ ".$user." ]</b><br /><br />$rep</div></body></html>";
            $mail = @mail($to, $subject, $message, $headers);

            if($mail){
                $this->success("Feedback was successful sent!");
            }else{
                $this->error('The reply could not be sent. Please try again!');
            }
        }else{
            $this->error('Sorry something went wrong Please try again!');
        }
    }

    private function count_feedback($type = false){
        $result = '';
        $where = ($type) ? "WHERE approve = '1' ORDER BY id DESC" : " ORDER BY id DESC";


        $sql = $this->db->get_results("SELECT count(id) as c FROM feedback $where");

        if($sql){
            foreach ($sql as $item) {
                $result = (int) $item->c;
            }

        }

        return $result;
    }

    public function pagenate(){
        $type = htmlentities($_POST['type']);
        $page = preg_replace('#[^0-9]#','',$_POST['page']);
        $last = preg_replace('#[^0-9]#','',$_POST['last']);
        $limit_page = preg_replace('#[^0-9]#','',$_POST['limit']);

        $result = '';
        $error = '';
        $type = ($type === 'home') ? true : false;
        $rows = $this->count_feedback($type);

        if($page < 1){
            $page = 1;
        }else if($page > $last){
            $page = $last;
        }

        $controls = '';

        $where = ($type) ? "WHERE approve = '1' ORDER BY id DESC LIMIT ".($page-1) * $limit_page.", $limit_page" : " ORDER BY id DESC LIMIT ".($page-1) * $limit_page.", $limit_page";

        $sql = $this->db->get_results("SELECT * FROM feedback $where");

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
            $error = 'No records found';
            if($type){
                $error = "<ul id=\"recentcomments\">
                            <li class=\"recentcomments\">
                            $error
                            </li>
                            </ul>";
            }else{
                $error = "<tr>
                            <td>
                                $error
                            </td>
                        </tr>";
            }
        }


        if(!empty($result)){
            $this->success($result);
        }else{
            $this->error($error);
        }
    }

    public function addColumn(){
        if(isset($_POST['col']) && !empty($_POST['col'])){
            $c = htmlentities($_POST['col']);

            $result = $this->db->query("ALTER TABLE feedback ADD COLUMN $c");

            if($result){
                $this->success("Column created!");
            }else{
                $this->error('Column could not be created!');
            }
        }
    }

    public function get_requested_method(){
        $method = $_SERVER['REQUEST_METHOD'];
        return $method;
    }

    private function error($error,$code = ''){
        echo $this->response(array('error'=>$error,'code'=>$code));
    }

    private function success($success){
        echo $this->response(array('success'=>$success));
    }

    public function response($r){
        return json_encode($r);
    }


}

new Ajax();