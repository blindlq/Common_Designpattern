<?php
	/**
	 * 单例模式，应用该模式有且只有一个对象，提供了唯一实例的访问
	 * 内存中，有且仅有一个对象，节约了系统资源，提高了性能
	 */
	
	//单利模式是其他对象无法实例化，但是自己可以实例化自己，所以要给自己留一个后门，这样才能完成自己的实例化
	class Single{
		//定义一个私有的静态成员变态
		private static $_instance;
		private final function __construct(){//私有构造函数为空，外部无法实例化
		
		}
		//保存类的唯一性，保存类的单一性
		private function __clone(){}
		//有且只有自己能实例化自己
		public static function getinstance(){
			if(!(self::$_instance instanceof self)){//没有对象就实例化自己
				self::$_instance = new Single();
			}
				return self::$_instance;//实例化成功返回实例对象
		}
		//定义2个get，set类验证单例
		public function setname($name){
			$this->name = $name;
		}
		public function getname(){
			echo $this->name; 
		}
	}
	
	$test = Single::getinstance();
	$test->setname('This is a single example');
	$test->getname();
	//-- This is a single example  --//
	
	$test = new Single();
	$test->setname('This is a single example11');
	$test->getname();
	//--  Call to private Single::__construct() from invalid context  --//
	
	
	/**
	 * 单例的缺点也很明显
	 * 单一职责过重，可以说违背了“单一职责”
	 * 单例滥用，或者过多被创建，反而会对性能造成影响
	 */
	
?>