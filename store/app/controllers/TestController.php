
<?php
use Phalcon\Mvc\Controller;

class TestController extends Controller
{

    public function commentAction()
    {

    }

    /**
     *   @purpose  删除修改
     *   @author chifangyi
     *   @created 2019/3/25 10:48
     *  
     */
    public function commentDoAction()
    {
        $comobj = new \Comment1();
        $id    = $this->request->getPost("id","int");
        $title = $this->request->getPost("title");
        $com   = $this->request->getPost("com");
        $this->sqlPost($title);
        $this->sqlPost($com);
        if (!isset($title{0}) || !isset($com{0})) {
            $this->flash->error(
                "您好，请务必输入标题或内容"
            );
            echo "<a href='../test/comment'>返回</a>";
            exit();
        }
        $data = array("id"=>$id,"title"=>$title,"com"=>$com);
        $success = $comobj->addComment($data);
        if ($success) {
            //成功跳转到Test\suc
            return $this->dispatcher->forward(
                [
                    "controller" => "Test",
                    "action" => "show"
                ]
            );
        }

    }

    /**
     * @purpose 列表展示
     */
    public function showAction()
    {
        $sear   = $this->request->getQuery("sear");
        $currentPage = $this->request->getQuery("page","int",1);
        $comment = Comment1::getPaginate($currentPage,5,$sear);
        $this->view->setVars(array("page"=>$comment,"sear"=>$sear));
    }

    /**
     *   @purpose 详情页
     *   @author chifangyi
     *   @created 2019/3/25 10:48
     *  
     */
    public function detailAction()
    {
        $id =$this->request->getQuery("id","int");
        $this->integer($id);
        $data = Comment1::getOneComment("id=$id","type_id,title,com,created_at");
        $this->is_null($data);
        $this->view->setVar("data",$data);
    }

    /**
     *   @purpose 修改页面
     *   @author chifangyi
     *   @created 2019/3/25 10:48
     *  
     */
    public function updateAction()
    {
        $id =$this->request->getQuery("id","int");
        $this->integer($id);
        $data = Comment1::getOneComment("id=$id","id,title,com,created_at");
        $this->is_null($data);
        $this->view->setVar("data",$data);
    }


    /**
     *   @purpose   删除文章
     *   @author chifangyi
     *   @created 2019/3/25 10:47
     *  
     */
    public function deleteAction()
    {
        $id =$this->request->getQuery("id","int");
        $this->integer($id);
        $data = Comment1::getOneComment("id=$id","id");
        if($data != false)
        {
            Comment1::deleteComment("id=$id");

        }
        return $this->dispatcher->forward(
                [
                    "controller" => "Test",
                    "action" => "show"
                ]
        );

    }


    /**
     *   @purpose   匹配是否是int整型
     *   @author chifangyi
     *   @created 2019/3/25 10:47
     *  
     */
    public function integer($num)
    {
        if(!$this->regex->integer($num))
        {
            $this->flash->error(
                "403"
            );
            echo "<a href='../test/comment'>返回</a>";
            exit();
        }
    }


    /**
     *   @purpose   判断数据是否存在
     *   @author chifangyi
     *   @created 2019/3/25 10:46
     *  
     */
    public function is_null($data)
    {
        if(!$data)
        {
            $this->flash->error(
                "403"
            );
            echo "<a href='../test/comment'>返回</a>";
            exit();
        }
    }

    /**
     *   @purpose   匹配是否含有SQL注入字符
     *   @author chifangyi
     *   @created 2019/3/25 10:47
     *  
     */
    public function sqlPost($parameter)
    {
        if($this->regex->sqlPost($parameter))
        {
            $this->flash->error(
                "请勿输入敏感字符"
            );
            echo "<a href='../test/comment'>返回</a>";
            exit();
        }
    }


}