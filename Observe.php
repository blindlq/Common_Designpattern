<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/12/21
 * Time: 下午11:23
 */
    //定义抽象的被观察者类
    abstract class observed{
     //注册观察者方法
        abstract public function add(observer $observer,$type);
     //删除观察者方法
        abstract public function del(observer $observer,$type);
     //通知观察者
        abstract public function notify($type);
    }

    //定义抽象观察者类
    abstract class observe{
        abstract public function update(observer $observer,$type);
    }
    //实例化被观察者
    class user extends observerd{
        CONST OBSERVER_TYPE_REGISTER = 1;//注册
        CONST OBSERVER_TYPE_LOGIN = 2;//登陆
        //保存私有观察者实例
        private $observers;
        //保存姓名
        public $name;

        public function add(observer $observer,$type){
            $this->observers[$type][]= $observer;
        }
        public function del(observer $observer,$type){
            if($index = arrar_search($observer,$this->observers[$type],true)){
                    unset($this->observers[$type][$index]);
            }
        }
//        触发通知方法
        public function notify($type){
            if(!empty($this->observers[$type])){
                foreach ($this->observers[$type] as $observer){
                    $observer->update($this,$type);
                }
            }
        }
        //定义登陆方法
        public function login($name){
            $this->name = $name;
            //添加观察者
            $action = new action();
            $this->add($action,self::OBSERVER_TYPE_REGISTER);
            $log = new log();
            $this->add($log,self::OBSERVER_TYPE_REGISTER);
            //通知观察者
            $this->notify(self::OBSERVER_TYPE_REGISTER);

        }
    }

    //实例化观察者
    class action extends observe{
        public function update(observer $observer,$type){
            // TODO: Implement update() method.
            if ($type == 1){
                echo 'login:add action'.$observer->name.'<br>';
            }
        }
    }

    class log extends observe{
        public function update(observer $observer, $type){
            // TODO: Implement update() method.
            if ($type == 1) {
                echo 'log:write log for'.$observer->naem.'<br>';
            }
        }
    }

    $user = new user();
    $user->login('test oberser');