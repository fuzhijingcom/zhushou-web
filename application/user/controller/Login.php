<?php
namespace app\user\controller;

use think\Controller;

class Login extends Controller
{

    public function _initialize()
    {
        //记录日志
        add_log(session('user.user_id'));
    }

    /**
     * 登录首页
     */
    public function index()
    {
        session('redirect_uri', input('redirect_uri'));
        //这是上一页

        //已经登录了
        $token = session("token");
        if ($token) {
            $this->redirect("index/index/index");
            exit;
        }

        if (is_weixin() == true) {
           
            //$u = urlencode("https://kd.c3w.cc/user/login/check");
            //$wx_login = "https://account.c3w.cc/?redirect_uri=" . $u;
            //微信强制跳转
            //$this->redirect($wx_login);
            //exit;
            //$this->assign("wx_login", $wx_login);

        } else {
            //$this->assign("wx_login", "javascript:alert('请在微信中打开')");
        }

        if ($this->request->method() == 'POST') {
            $username = input('username');
            $password = input("password");

            $url = "https://api5.c3w.cc/school/admin/login?from=web&account=" . $username . "&password=" . $password . "&openid=web&address=no";

            $res = httpRequest($url, "GET");
            $res = json_decode($res, true);

            if ($res['status'] == 1) {

                $data = $res['data'];
                // 用户信息存 session
                session("seller_id", $data['seller_id']);
                session("token", $data['token']);
                session("schoolname", $data['schoolname']);

                //有没有上一步地址
                if (session('redirect_uri')) {
                    $this->redirect(session('redirect_uri'));
                    exit;
                } else {
                    $this->redirect("index/index/index");
                }

            } else {
                $this->error($res['msg']);
            }
            exit;
        }
        return $this->fetch();
    }


    /**
     * 退出登录
     */
    public function logout(){
        session(null);
        session_destroy();
        $this->redirect('index');
    }

}
