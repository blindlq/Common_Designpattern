<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 12:46
 */

	/*
	 *一般来说，我们在开发中对类的使用一般都是直接new,但是随着项目过大，版本增加，可能会出现项目中对某个类过于依赖，
	 * 以至于无法管理，这时候可以考虑使用工厂模式。工厂模式，顾名思义，可以根据传入的参数，返回具体的类，这样可以简化
	 * 对象创建。
	 *
	 */

		//定义抽象的类	
		abstract class Animal{
			//属性
			protected $name;
			protected $eat;
			
			public function __construct($name,$eat){
				$this->name = $name;
				$this->eat = $eat;
			}
			
			abstract protected function introduce();
				
			
		}
		//定义不同的类继承抽象类，并且实现其父类的抽象方法
		class tigger extends Animal{
			public function introduce(){
				echo 'name: '.$this->name.'eat: '.$this->eat.'<br>';
			}
			
			public function like_eat($foods){
				echo 'name: '.$this->name.'like_eat: '.$foods.'<br>';
			}
		}
		
		class rabbit extends Animal{
			public function introduce(){
				echo 'name: '.$this->name.'eat: '.$this->eat.'<br>';
			}
			
			public function like_eat($foods){
				echo 'name: '.$this->name.'like_eat: '.$foods.'<br>';
			}
		}
		//定义工厂类，生产实体类
		class Factory{
			//保存实例对象
			private static $obj;
			public static function Create_obj($kind,$name,$eat){
				//根据参数返回不同的实例对象
				self::$obj = new $kind($name,$eat);
				return self::$obj;
			}
		}
		
		//使用工厂
		$obj = Factory::Create_obj('tigger','xinba','meat');
		$obj->introduce();
		$obj->like_eat('chicken');
		
		$obj = Factory::Create_obj('rabbit','xiaobai','grass');
		$obj->introduce();
		$obj->like_eat('carrot');
		
		
		
?>