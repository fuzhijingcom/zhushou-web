<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{

    public function _initialize()
    {

        //检查是否登录
        if ($this->request->action() != 'logout') {
            //排除 logout
            $login = new \app\common\controller\Login();
            $login->check_login();
        }
    }

    public function index()
    {
        $token = session("token");
        $seller_id = session("seller_id");
        $schoolname = session("schoolname");

        $this->assign('token', $token);
        $this->assign('seller_id', $seller_id);
        $this->assign('schoolname', $schoolname);

        return $this->fetch();
    }

}
