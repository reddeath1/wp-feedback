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

        if($_POST['fn'] !== ''
            && $_POST['ln'] !== ''
            && $_POST['em'] !== ''
            && $_POST['pn'] !== ''
            && $_POST['dp'] !== ''
            && $_POST['fd'] !== ''){

            $fn = sanitize_user($_POST['fn']);
            $ln = sanitize_user($_POST['ln']);
            $pn = sanitize_text_field($_POST['pn']);
            $em = sanitize_email($_POST['em']);
            $dp = sanitize_text_field($_POST['dp']);
            $fd = sanitize_textarea_field($_POST['fb']);


            $sql = $this->db->insert('feedback',array(
                'username'=>$fn.' '.$ln,
                'phone'=>$pn,
                'email'=>$em,
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
            $this->error('All fields are required');
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
            $email = preg_replace('#[^a-z0-9-@.]#i','',$_POST['e']);
            $to = $email;
            $subject = "RE: Darceramica Customer Support";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $message = "<p>Hello $user</p>
                          <p>$rep</p>";

            $mail =  mail($to,$subject,$message,$headers);

            if($mail){
                $this->success("Feedback was successful sent!");
            }else{
                $this->error('The reply could not be sent. Please try again!');
            }
        }else{
            $this->error('Sorry something went wrong Please try again!');
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