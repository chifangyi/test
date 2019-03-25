
<?php
use Phalcon\Mvc\Model,
    Phalcon\Validation\Validator\Uniqueness,
    Phalcon\Validation\Validator\InclusionIn,
    Phalcon\Mvc\Model\Behavior\Timestampable;
class Comment1 extends Model{
    public $id;
    public $title;
    public $com;
    public function initialize()
    {
        $this->setup(
            array('notNullValidations'=>false)
        );
        $this->setSource('comment1');
        $this->addBehavior(
            new Timestampable(
                [
                    "beforeCreate" => [
                        "field"  => "created_at",
                        "format" => "Y-m-d H:i:s",
                    ],
                    "beforeSave" => [
                        "field"  => "created_at",
                        "format" => "Y-m-d H:i:s",
                    ],

                ]
            )
        );
    }


    /**
     *   @purpose  添加修改文章
     *   @author chifangyi
     *   @created 2019/3/25 10:44
     *  
     */
    public function addComment($data=array())
    {
        // save 方法可以更新和修改, 如果data数组中存在id，就更新，没有id就自动插入，第二个字断是一个数组，可以指定更新的字断
       return $this->save($data);
    }

    /**
     *   @purpose   获取文章
     *   @author chifangyi
     *   @created 2019/3/25 10:44
     */
    public static function getComment($columns='*',$order='id')
    {
        $comment = self::find(array(
            "order" => $order,
            "columns"=>$columns
        ))->toArray();
        return $comment;
    }

    /**
     *   @purpose   获取一条文章
     *   @author chifangyi
     *   @created 2019/3/25 10:45
     *  
     */
    public static function getOneComment($where,$columns='*')
    {
        $comment = self::find(array(
            $where,
            "columns"=>$columns
            ))->toArray();
        return $comment;
    }

    /**
     *   @purpose   分页查询
     *   @author chifangyi
     *   @created 2019/3/25 10:45
     *  
     */
    public static function getPaginate($currentPage,$limit,$where="")
    {
        $data = self::find([
            'conditions' => 'title LIKE :title:',
            'bind' => ['title' => '%'."$where".'%']
        ]);
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data" => $data,
                "limit"=> $limit,
                "page" => $currentPage
            )
        );
        $page = $paginator->getPaginate();
        return $page;
    }

    /**
     *   @purpose   删除文章
     *   @author chifangyi
     *   @created 2019/3/25 10:46
     *  
     */
    public static function deleteComment($where){
        return self::findFirst($where)->delete();
    }
}
