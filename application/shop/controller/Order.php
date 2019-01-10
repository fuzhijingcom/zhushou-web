<?php
namespace app\shop\controller;

use think\Controller;

//订单

class Order extends Controller
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

    /**
     * 首页
     */
    public function index()
    {
        $token = session("token");
        $seller_id = session("seller_id");
        $schoolname = session("schoolname");

      

        return $this->fetch();
    }

   

}
