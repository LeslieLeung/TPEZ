<?php


namespace app\controller;


use app\Request;
use think\App;

class Admin extends ResponseController
{
    private $adminService;
    private $data;
    private $id;

    public function __construct(App $app, Request $request)
    {
        parent::__construct($app);
        $this->id = $request->id;
        $this->data = $request->data;
        $this->adminService = invoke("app\service\AdminService");
    }

    public function helloAdmin()
    {
        return $this->renderSuccess("Hello admin!");
    }
}