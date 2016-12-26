<?php
namespace Myweb\Controller;
use Think\Controller;
class JjrController extends Controller {
    public function __construct() {
        parent::__construct();
        C('DEFAULT_THEME','Jjr');
    }

    public function index(){
        $this->display('inde');
    }
}