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
                $this->error('0',"Error bad request");
            }

        }else{
            $this->error('0',"Error bad request");
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