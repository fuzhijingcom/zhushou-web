<?php
namespace app\shop\controller;

use think\Controller;

class Config extends Controller
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

        $url = CONFIG('api5_url')."school/admin/get_shop_config?seller_id=".$seller_id;
        $res = httpRequest($url,'GET');
        if(!$res){
            $this->error('请求出错');
        }
        $res = json_decode($res,true);
        if($res['status'] == 1){
            $data = $res['data'];
        }else{
            $this->error($res['msg']);
        }

        $this->assign('data', $data);
        return $this->fetch();
    }
}
