<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8
 * Time: 17:39
 */
//建造者模式
/*******************************/
//建造者模式可以说是更复杂的工厂模式，建造者模式是对复杂类（类的构件很多时）分别抽离各个部件
//对每个部件进行类似工厂模式的处理，可以理解为建造者模式是由多个工厂模式组成
//一般而言，建造者模式由几个部分组成：
//1.产品类，demo中我以一个简单具体类为例，但是在具体生产环境中，一般是一个抽象类和多个不同实现的子类组成
//2.抽象建造者，一个抽象类接口，规范产品类的各个构件的生产
//3.具体建造者，抽象建造者的实现类，完成产品的各个构件的生产，并返回组建好的产品类
//4.导演者，通过一定调用关系，来实现产品的生产，同时减少产品类和建造者类直接的耦合
/*******************************/
//这里还是用汽车为例
class Car{
    public $brand;//汽车品牌
    public $type;//汽车类型
    public $enginceer;//汽车引擎

   public function show(){
        echo 'The car is'.$this->brand.'<br />';
        echo 'The car type is'.$this->type.'<br />';
        echo  'the '.$this->brand.'enginceer'.$this->enginceer;
    }
}

//抽象建造者类
abstract class carbuild{
        protected $_car;

     public function __construct()
        {
            $this->_car = new Car();
        }

        protected abstract function buildbrand();
        protected abstract function buildtype();
        protected abstract function buildenginceer();
        protected abstract function build_get_car();
}

//具体的建造者类
class Benz extends carbuild{//实现抽象建造者类

  public  function buildbrand(){
        $this->_car->brand = 'Benz';
    }

   public function buildtype(){
        $this->_car->type = 'SUV';
    }

    public function buildenginceer(){
       $this->_car->enginceer = 'V';
    }
    public function build_get_car(){
        return $this->_car;
    }
}

class Audio extends carbuild{//实现抽象建造者类

    public  function buildbrand(){
        $this->_car->brand = 'Audio';
    }

    public function buildtype(){
        $this->_car->type = 'MPV';
    }

    public function buildenginceer(){
        $this->_car->enginceer = 'W';
    }
    public function build_get_car(){
        return $this->_car;
    }
}

class Porsche extends carbuild{//实现抽象建造者类

    public  function buildbrand(){
        $this->_car->brand = 'Porsche';
    }

    public function buildtype(){
        $this->_car->type = 'Roadster';
    }

    public function buildenginceer(){
        $this->_car->enginceer = 'X';
    }
    public function build_get_car(){
        return $this->_car;
    }
}


//导演类
 class Director {
    public function Construct($_builder){
        $_builder->buildbrand();
        $_builder->buildtype();
        $_builder->buildenginceer();
        return $_builder->build_get_car();
    }
 }


 //**************测试************//

$director = new Director();

$Benz = $director->Construct(new Benz);
$Benz->show();

$Audio = $director->Construct(new Audio);
$Audio->show();

$Porsche = $director->Construct(new Porsche);
$Porsche->show();






?>