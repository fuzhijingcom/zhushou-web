<?php
namespace app\shop\controller;

use think\Controller;

//商品
class Goods extends Controller
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

        $url = CONFIG('api5_url')."school/admin/goods_list?seller_id=".$seller_id;
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


    /**
     * 编辑商品
     */
    public function edit(){
        

        if($this->request->method() == "POST"){

            $goods_id = input('goods_id');

            $goods_name = input('goods_name');
            $price=input('price');
            $packing_fee=input('packing_fee');
            $sales=input('sales');
            $stock=input('stock');
            $detail=input('detail');
    
            $url = CONFIG('api5_url')."school/admin/goods_edit?goods_id=".$goods_id."&goods_name=".$goods_name."&price=".$price."&packing_fee=".$packing_fee."&sales=".$sales."&stock=".$stock."&detail=".$detail;
            $res = httpRequest($url,'GET');
          
            $res = json_decode($res,true);
           
            if(!$res){
                $this->error('请求出错');
            }
          
            if($res['status'] == 1){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }

            exit;

        }

        $goods_id = input('goods_id');

        $url = CONFIG('api5_url')."school/admin/goods_detail?goods_id=".$goods_id;
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

    /**
     * 增加商品
     */
    public function add(){


        if($this->request->method() == "POST"){

            $seller_id = session("seller_id");
            $goods_name = input('goods_name');
            $price = input('price');
            $packing_fee = input('packing_fee');
            $sales = input('sales');
            $stock = input('stock');
            $detail = input('detail');
    
            $url = CONFIG('api5_url')."school/admin/goods_add?seller_id=".$seller_id."&goods_name=".$goods_name."&price=".$price."&packing_fee=".$packing_fee."&sales=".$sales."&stock=".$stock."&detail=".$detail;
            $res = httpRequest($url,'GET');
          
            $res = json_decode($res,true);
           
            if(!$res){
                $this->error('请求出错');
            }
          
            if($res['status'] == 1){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
            exit;
        }


        return $this->fetch();
    }



}
