CakePHP 2.x plugin for Twitter Bootstrap 2.0 Compatible output
============


Includes:
-------

	View Helpers for CakePHP to use the correct class' for TwitterBootstrap
	Have submodule to TwitterBootstrap itself

	You can either include bootstrap.min.js in order to get support for all twitter bootstrap JS feature,
	or you can include each module as you wish to use. See below.


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
	echo $this->Html->css('/twitter_bootstrap/bootstrap.min');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-buttons');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-alerts');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-dropdown');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-modal');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-popover');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-scrollspy');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-tabs');
	echo $this->Html->script('/twitter_bootstrap/js/bootstrap-twipsy');


Christian Winther
Kim Egede Jakobsen
Andreas Kristiansen
@Nodes.dk 2012
