<?php

class DatabaseController extends ControllerBase
{
    //添加
    public function insertAction()
    {
        $customer = new Customer();

        $customer->username = 'kimi66666666';
        $customer->password = '123456';
        //$customer->setUsername($customer->username);
        $ret = $customer->save();

        if($ret){
            print_r('插入成功');
        } else {
            print_r('插入失败');
        }
    }
    //查询
    public function findAction()
    {
        $customers = Customer::find();
        $result = [];
        foreach ($customers as $customer) {
            $result[] = [
                'username' => $customer->username,
                'password' => $customer->password,
            ];
        }
        $this->response->setContentType('application/json', 'UTF-8');
        return $this->response->setJsonContent($result);
    }
    //查询一条
    public function findfirstAction()
    {
        //$customer = Customer::findFirst("username = 'liyi1'");
        $customer = Customer::findFirstByUsername('liyi2');
        $result = [
            'username' => $customer->username,
            'password' => $customer->password,
        ];
        $this->response->setContentType('application/json', 'UTF-8');
        return $this->response->setJsonContent($result);
    }
    //登录验证
    public function loginAction()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $conditons = 'username = :username: and password = :password:';
        $parameters = [
            'username' => $username,
            'password' => $password,
        ];
        $ret = Customer::findFirst(
            [
                $conditons,
                'bind' => $parameters,
            ]);

        if ($ret) {
            print_r('login success');
        } else {
            print_r('login failed');
        }
    }


    //修改
    public function updateAction()
    {
        $password = $this->request->getPost('password');
        $newpassword = $this->request->getPost('newpassword');

        $conditons = 'username = :username: and password = :password:';
        $parameters = [
            'username' => 'liyi2',
            'password' => $password,
        ];
        $customer = Customer::findFirst([
            $conditons,
            'bind' => $parameters,
        ]);

        if($customer){
            $customer->password = $newpassword;
            $customer->save();
            print_r('更新成功');
        } else {
            print_r('用户名不存在或密码错误');
        }
    }
    //删除
    public function deleteAction()
    {
        $customer = Customer::findFirstByUsername('liyi1');

        if($customer){
            $res = $customer->delete();
            if($res) {
                print_r('删除成功');
            } else {
                print_r('删除失败');
            }
        } else {
            print_r('用户不存在');
        }
    }

}