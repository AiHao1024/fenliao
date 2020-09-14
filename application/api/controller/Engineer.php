<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 工程师
 */
class Engineer extends Api
{
    protected $noNeedLogin = ['index'];
    protected $noNeedRight = ['*'];

    /**
     * 工程师列表
     *
     * @ApiParams   (name="sort", type="integer", required=true, description="排序方式:好评：score 默认：sort 经验：order_num")
     * @ApiReturnParams (name="name", type="string", required=true, description="名字")
     * @ApiReturnParams (name="score", type="string", required=true, description="评分")
     * @ApiReturnParams (name="sort", type="string", required=true, description="sort")
     * @ApiReturnParams (name="avater_image", type="string", required=true, description="头像")
     * @ApiReturnParams (name="detail", type="string", required=true, description="介绍")
     * @ApiReturnParams (name="order_num", type="string", required=true, description="订单数")
     */
    public function index()
    {
        $sort=$this->request->request('sort');
        if(!$sort){
            $sort='sort';
        }
        $data=Db::name('engineer_list')->where('status','normal')->order($sort.' desc')->select();
        foreach ($data as $key=>$value){
            $data[$key]['create_time']=date('Y-m-d',$value['create_time']);
        }
        $this->success(__('查找成功'), $data);
    }

    /**
     * 工程师流程图
     *
     */
    public function engineer_flow()
    {
        $data=Db::name('engineer_flow')->select();
        $this->success(__('查找成功'), $data);
    }

    /**
     * 工程师搜索
     *
     * @ApiParams   (name="name", type="integer", required=true, description="搜索词")
     */
    public function engineer_like()
    {
        $name=$this->request->request('name');
        $data=Db::name('engineer_list')->where('name|detail','like','%'.$name.'%')->select();
        $this->success(__('查找成功'), $data);
    }


//    /**
//     * 工程师注册
//     *
//     * @ApiParams   (name="name", type="integer", required=true, description="名字")
//     * @ApiParams   (name="avater_image", type="integer", required=true, description="头像")
//     * @ApiParams   (name="detail", type="integer", required=true, description="介绍")
//     */
//    public function engineer_sign()
//    {
//        $user_id=$this->auth->id;
//        $is_set=Db::name('school_sign')->where('user_id',$user_id)->find();
//        if($is_set){
//            $this->error(__('已报名，请勿重复提交'));
//        }
//        $name = $this->request->request('name');
//        $school_name = $this->request->request('school_name');
//        $email = $this->request->request('email');
//        $phone = $this->request->request('phone');
//        $major = $this->request->request('major');
//        $create_time=time();
//        if(!$name || !$school_name || !$email || !$phone || !$major ){
//            $this->error(__('参数缺失'));
//        }
//        $data=['user_id'=>$user_id,'name'=>$name,'school_name'=>$school_name,'email'=>$email,'email'=>$email,'phone'=>$phone,'major'=>$major,'create_time'=>$create_time];
//        $result=Db::name('school_sign')->insert($data);
//        if($result){
//            $this->success(__('添加成功'), $result);
//        }else{
//            $this->error(__('添加失败'));
//        }
//
//    }


}