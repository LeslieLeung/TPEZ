<?php
//------------------------------
// Author: Leslie Leung
// Email: lesily9@gmail.com
//------------------------------

namespace app\controller;


use app\BaseController;
use think\response\Json;

class ResponseController extends BaseController
{
    /**
     * 输出json基本方法
     * @param $code
     * @param $msg
     * @param null|array $data
     * @return Json
     */
    private function renderJson(string $code, string $msg, array $data = null): Json
    {
        $out = [
            'code' => $code,
            'msg' => $msg,
        ];
        if (isset($data)) {
            $out['data'] = $data;
        }
        return json($out);
    }

    /**
     * 返回成功json（可选是否带数据）
     * @param string $msg
     * @param null|array $data
     * @return Json
     */
    protected function renderSuccess(string $msg = "请求成功", $data = null): Json
    {
        return $this->renderJson(JSON_SUCCESS, $msg, $data);
    }

    /**
     * 返回成功json（带数据）
     * @param array $data
     * @return Json
     */
    protected function renderData(array $data = []): Json
    {
        return $this->renderSuccess($msg = "请求成功", $data);
    }

    /**
     * 返回失败json
     * @param int $code
     * @param string $msg
     * @return Json
     */
    protected function renderError(string $code = JSON_USER_ERROR, string $msg = "请求失败"): Json
    {
        return $this->renderJson($code, $msg);
    }
}