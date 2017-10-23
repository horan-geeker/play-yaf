<?php

/**
 * @name IndexController
 * @author hejunwei
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class UserController extends Yaf_Controller_Abstract
{

    public function indexAction()
    {
        echo 'user index';
        return false;
    }

    public function showAction($id)
    {
        echo 'user show id:' . $id;
        return false;
    }

    public function storeAction()
    {
        $data = $this->getRequest()->getPost('data');
        var_dump($data);
        $transport = new \Swift_SmtpTransport('smtp.exmail.qq.com', 465, 'ssl');
        $transport->setUsername('bluestone@bluestoneapp.com');
        $transport->setPassword('Bluestone123');  //该密码为smtp密码具体自行百度设置
        $mailer = new \Swift_Mailer($transport);

        $message = new \Swift_Message();
        $message->setSubject('this is subject');
        $message->setFrom(array('bluestone@bluestoneapp.com' => '发信人的名字'));
        $message->setTo(array(
            '13571899655@163.com'
        ));
        $message->setBody("hi horan");
//        $message ->setPart('');
//        $message ->attach(''); //附件
        $result = $mailer->send($message);
//        printf("Sent %d messages\n", $result);
        return false;
    }

    /**
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/horan-yaf/index/index/index/name/hejunwei 的时候, 你就会发现不同
     */
    public function regAction($name = "horan")
    {
        //1. fetch query
        $get = $this->getRequest()->getQuery("get", "default value");

        //2. fetch model
        $model = new SampleModel();

        //3. assign
        $this->getView()->assign("content", $model->selectSample());
        $this->getView()->assign("name", $name);
        echo json_encode($name);
        //4. render by Yaf, 如果这里返回FALSE, Yaf将不会调用自动视图引擎Render模板
        return false;
    }
}
