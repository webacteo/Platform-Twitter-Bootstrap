<?php
$modelHumanNameSingular				= Inflector::humanize(Inflector::underscore($model)); // Project
$modelHumanNamePlural				= Inflector::pluralize($modelHumanNameSingular); // Projects
$modelHumanNameSingularLowerCase	= strtolower($modelHumanNameSingular); // project
$modelHumanNamePluralLowerCase		= strtolower($modelHumanNamePlural); // projects

$baseUrl = array(
	'prefix'		=> Router::getParam('prefix'),
	'plugin'		=> Router::getParam('plugin'),
	'controller'	=> Router::getParam('controller'),
	'action'		=> Router::getParam('action')
);

if (!isset($settings)) {
	$settings = array();
}

$settings = array_merge(array(
	'showHeader' => true
), (array)$settings);

$top_actions = array_merge(
	array(),
	!empty($top_actions) ? $top_actions : array()
);
uksort($top_actions, 'strcmp');

if ($settings['showHeader']) {
	?>
	<div class="header">
		<?php
		if ($this->Form->value(sprintf('%s.id', $model))) {
			?>
			<h4><?php echo sprintf('Edit %s', $modelHumanNameSingularLowerCase); ?></h4>
			<?php
		} else {
			?>
			<h4><?php echo sprintf('Create %s', $modelHumanNameSingularLowerCase); ?></h4>
			<?php
		}
		?>
	</div>
	<?php
}
?>

<!-- Basic information -->
<div class="row">
	<div class="span12 colums">
	<?php
	echo $this->Form->create($model);
		?>
		<fieldset>
			<?php
			if($this->Form->value(sprintf('%s.id', $model))) {
				echo $this->Form->input('id');
			}

			foreach ($columns as $column => $config) {
				if(is_array($config)) {
					$fieldName = $column;
					$default = array(
						'label' => $fieldName
					);
					$config = array_merge($default, $config);
				} else {
					$fieldName = $config;
					$config = array('label' => __d($modelHumanNamePluralLowerCase, ucfirst($fieldName)));
				}

				if($fieldName == 'id') {
					throw new Exception('Input "id" already exists.');
				}

				// Change label to human readable
				$config['label']	= pluginSplit($config['label']); // We only want the "label" part
				$config['label']	= Inflector::humanize(Inflector::underscore($config['label'][1]));

				if (isset($config['element']) && !empty($config['element'])) {
					echo call_user_func_array(array($this, 'element'), $config['element']);
				} else {
					echo $this->Form->input($fieldName, $config);
				}
			}
			?>
			<div class="actions">
				<button type="submit" class="btn primary"><?php echo __d('common', 'Save changes');?></button>
				&nbsp;
				<button type="reset" class="btn"><?php echo __d('common', 'Cancel');?></button>
			</div>
		</fieldset>
		<?php
	echo $this->Form->end();
	?>
	</div>
</div>