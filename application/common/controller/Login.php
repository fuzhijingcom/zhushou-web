<?php
namespace app\common\controller;
use think\Controller;

class Login extends Controller
{
    public function check_login()
    {

        $redirect_uri = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
        //判断是否合法的uri
        if(!preg_match('/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is',$redirect_uri)){
            $redirect_uri = '';
        }
       

        $token = session("token");
        if(!$token){
           $url = "/index.php/user/login/index?redirect_uri=".$redirect_uri;
           header("Location:".$url);
           exit;
        }

        return true;
    }

}
