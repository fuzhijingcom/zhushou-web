<?php
namespace app\shop\controller;

use think\Controller;

//商品

class Menu extends Controller
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
     * 菜单首页
     */
    public function index()
    {
        $token = session("token");
        $seller_id = session("seller_id");
        $schoolname = session("schoolname");

        $url = CONFIG('api5_url')."school/admin/menu_list?seller_id=".$seller_id;
        $res = httpRequest($url,'GET');
    
        $res = json_decode($res,true);
     
     
        if(!$res){
            $this->error('请求出错');
        }
       
        if($res['status'] == 1){
            $data = $res['data'];
        }else{
            $this->error($res['msg']);
        }

        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 增加分类
     */
    public function add(){
        return $this->fetch();
    }


}
