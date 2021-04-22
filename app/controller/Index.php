<?php
namespace app\controller;

use app\BaseController;
use app\Request;
use think\App;

class Index extends ResponseController
{
    private $indexService;
    private $data;
    private $id;

    public function __construct(App $app, Request $request)
    {
        parent::__construct($app);
        $this->id = $request->id;
        $this->data = $request->data;
        $this->indexService = invoke('app\service\IndexService');
    }

    public function login()
    {
        $res = $this->indexService->login($this->data['username'], $this->data['password']);
        if ($res == -1) {
            return $this->renderError(JSON_LOGIN_ERROR, '用户名或密码错误');
        } else {
            return $this->renderData(['token' => $res]);
        }
    }
}
