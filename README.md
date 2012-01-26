CakePHP 2.x plugin for Twitter Bootstrap 1.0 Compatible output

Setup (AppController):
	* 'Form' helper need to be changed to 'BootstrapForm' helper
	* 'Paginator' helper need to be changed to 'BootstrapPaginator' helper

	public $helpers = array(
		'Form'		=> 'BootstrapForm',
		'Paginator' => 'BootstrapPaginator'
	);

Usage
	In your default.ctp
	echo $this->Html->css('TwitterBootstrap/base/bootstrap.min');


Christian Winther & Kim Egede Jakobsen
@Nodes.dk 2012