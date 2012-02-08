CakePHP 2.x plugin for Twitter Bootstrap 2.0 Compatible output
============

Includes:
-------

	View Helpers for CakePHP to use the correct class' for TwitterBootstrap
	Have submodule to TwitterBootstrap itself

Setup:
-------
* Rememer to load the plugin in app/Config/bootstrap.php

	// Load TwitterBootstrap plugin, without loading bootstrap
	CakePlugin::load('TwitterBootstrap', array('bootstrap' => false));

* 'Form' helper need to be changed to 'BootstrapForm' helper
* 'Paginator' helper need to be changed to 'BootstrapPaginator' helper

	// Change default Form & Paginator
	public $helpers = array(
		'Form'		=> array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
	);


Using Crud plugin aswell?
	Add this to $helpers
		'Js'		=> array('className' => 'Crud.CrudJs', 'Jquery')

Usage ex.
-------
	In your default.ctp
	echo $this->Html->css('TwitterBootstrap/base/bootstrap.min');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-buttons');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-alerts');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-dropdown');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-modal');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-popover');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-scrollspy');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-tabs');
	echo $this->Html->script('TwitterBootstrap/base/js/bootstrap-twipsy');


Christian Winther & Kim Egede Jakobsen
@Nodes.dk 2012