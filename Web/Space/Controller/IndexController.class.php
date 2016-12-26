<?php
namespace Space\Controller;


class IndexController extends BaseController {
    /**
     * 进入首页
     */
    public function index(){
        $this->display('in');
    }

}