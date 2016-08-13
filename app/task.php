<?php
namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );

class Task_Base{
	static public $base=['jog'=>'noname',
						'tmpl'=>'base.html',
						'trait'=>['app/aapp/base'],
						'func'=>['base'],
						'nojogtrait'=>'app/aapp/nincsjog'];
	
}
class Task_ADBase extends Task_Base{
	static public $del=['jog'=>'admin',
			'tmpl'=>'base.html',
			'trait'=>['app/aapp/base'],
			'func'=>['del',[]],
			'next'=>'base',
			'nojogtrait'=>'app/aapp/nincsjog'];
	

}