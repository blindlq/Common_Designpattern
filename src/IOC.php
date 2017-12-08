<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/7
 * Time: 17:29
 */

/**
 * IOC控制反转模式，控制反转的目的是为了降低项目之间的耦合，减少对某些类的依赖
 * 方便项目的迭代和迁移。IOC思想一定程度上借鉴了工厂模式
 * IOC的常见的解决方式
 * 1.构造方式
 * 2.外部方法注入
 * 3.通过接口注入（接口注入和工厂模式结合一下就是我们通常所说的依赖注入了，依赖注入经常会跟反射结合在一起使用）
 *
 *
 * 依赖注入和控制反转不是一回事，，控制反转是目的，依赖注入是解决目的的方法。
 */

//定义接口
    interface Car{
        public function showBrand();
    }

    //实现接口
    class Benz implements Car{


        public function showBrand()
        {
            // TODO: Implement showBrand() method.
            echo "Benz brand: 奔驰!";
        }
    }

    class Audio implements Car{

        public function showBrand()
        {
            // TODO: Implement showBrand() method.
            echo "Audio brand: 奥迪!";
        }
    }
    //定义工厂类
    class AddCar{
        protected $car;
        public function __construct(Car $car)
        {
            $this->car = $car;
        }
        //生成类
        function create(){

            return new $this->car;
        }
    }
    //构建一个粗糙的容器
    class Container{
        protected $binds = [];
        protected $instances = [];

        public function bind($factory,$product){
            if($product instanceof Closure){//通过闭包传递参数
                $this->binds[$factory] = $product;
            }else{
                $this->instances[$factory] = $product;
            }
        }
        public function make($factory,$param = []){
            if(isset($this->instances[$factory])){
                return $this->instances[$factory];
            }

            array_unshift($param,$this);
            //回调类
            return call_user_func_array($this->binds[$factory],$param);
        }
    }
    //初始化容器
    $IOC = new Container;
    //添加工厂类
    $IOC->bind('addcar',function ($IOC,$car){
            return new Add_Car($IOC->make($car));
    });
    //添加工厂类生成类
    $IOC->bind('benz',function ($IOC){
        return new Benz;
    });
    //添加工厂类生成类
    $IOC->bind('audio',function ($IOC){
        return new Audio;
    });

    //********开始生产***************//
    $car1 = $IOC->make('addcar','benz')->create();
    $car2 = $IOC->make('addcar','audio')->create();
    //验证生产
    $car1->showBrand();
    $car2->showBrand();


?>