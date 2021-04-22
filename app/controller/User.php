<?php


namespace app\controller;


use app\Request;
use think\App;

class User extends ResponseController
{
    private $userService;
    private $data;
    private $id;

    public function __construct(App $app, Request $request)
    {
        parent::__construct($app);
        $this->userService = invoke("app\service\UserService");
        $this->data = $request->data;
        $this->id = $request->id;
    }

    public function helloUser()
    {
        return $this->renderSuccess("Hello user!");
    }
}