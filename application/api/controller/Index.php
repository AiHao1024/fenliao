<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];


    /**
     * 轮播图
     *
     */
    public function banner()
    {
        $data=Db::name('banner')->select();
        $this->success(__('查找成功'), $data);
    }

    /**
     * 公司信息概论
     *
     */
    public function company()
    {
        $data=Db::name('company')->select();
        $this->success(__('查找成功'), $data);
    }

    /**
     * 滚动订单
     *
     */
    public function order()
    {
        $data=Db::name('manufacture_order')->order('id desc')->select();
        $this->success(__('查找成功'), $data);
    }

    /**
     * 新闻中心
     *
     * @ApiParams   (name="type", type="integer", required=true, description="新闻类型 1：行业新闻 2公司动态 0：全部")
     * @ApiParams   (name="page", type="integer", required=true, description="页码 每页10条数据")
     */
    public function news()
    {
        $limit=10;
        $type = $this->request->request('type');
        $page = $this->request->request('page');
        if($type==0){
            $data=Db::name('news')->page($page,$limit)->select();
        }else{
            $data=Db::name('news')->where('type',$type)->page($page,$limit)->select();
        }
        foreach ($data as $key=>$value){
            $data[$key]['create_time']=date('Y-m-d',$value['create_time']);
        }
        $this->success(__('查找成功'), $data);
    }


    /**
     * 合作商
     *
     */
    public function partner()
    {
        $data=Db::name('partner')->select();
        foreach ($data as $key=>$value){
            $data[$key]['create_time']=date('Y-m-d',$value['create_time']);
        }
        $this->success(__('查找成功'), $data);
    }

    /**
     * 公司信息
     *
     */
    public function company_news()
    {
        $data=Db::name('company_news')->find();
        $this->success(__('查找成功'), $data);
    }


    /**
     * 备案信息
     *
     */
    public function keep_record()
    {
        $data=Db::name('config')->where('name','beian')->field('value')->find();
        $this->success(__('查找成功'), $data);
    }




}
