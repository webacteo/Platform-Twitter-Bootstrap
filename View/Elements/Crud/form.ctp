<?php
$modelHumanNameSingular = Inflector::humanize(Inflector::underscore($model)); // Project
$modelHumanNamePlural	= Inflector::pluralize($modelHumanNameSingular); // Projects
$modelHumanNameSingularLowerCase = strtolower($modelHumanNameSingular); // project
$modelHumanNamePluralLowerCase = strtolower($modelHumanNamePlural); // projects

$baseUrl = array(
	'prefix'		=> Router::getParam('prefix'),
	'plugin'		=> Router::getParam('plugin'),
	'controller'	=> Router::getParam('controller'),
	'action'		=> Router::getParam('action')
);

$top_actions = array_merge(
	array(),
	!empty($top_actions) ? $top_actions : array()
);
uksort($top_actions, 'strcmp');
?>

<div class="page-header">
	<?php
	$displayField = (isset($displayField) && !empty($displayField)) ? $displayField : 'name'; // @todo fix read $model->displayField

	if ($this->Form->value(sprintf('%s.id', $model))) {
		?>
		<h2><?php echo __d($modelHumanNamePluralLowerCase, sprintf('Edit %s', $modelHumanNameSingularLowerCase)); ?> <small><?php echo __d($modelHumanNamePluralLowerCase, 'You are currently editing "%s"', $this->Form->value(sprintf('%s.%s', $model, $displayField))); ?></small></h2>
		<?php
	} else {
		?>
		<h2><?php echo __d($modelHumanNamePluralLowerCase, sprintf('Create %s', $modelHumanNamePluralLowerCase)); ?> <small><?php echo __d($modelHumanNamePluralLowerCase, sprintf('Create a new %s', $modelHumanNamePluralLowerCase)); ?></small></h2>
		<?php
	}
	?>
	<div class="page-header-actions">
		<?php
		foreach ($top_actions as $action) {
			if (is_callable($action)) {
				echo call_user_func($action, $this, $baseUrl, $model);
			} else {
				echo $action;
			}
			echo '&nbsp;';
		}
		?>
	</div>
</div>

<!-- Basic information -->
<div class="row">
	<div class="span4 colums">
		<h2><?php echo __d($modelHumanNamePluralLowerCase, 'Basic information'); ?></h2>
		<p><?php echo __d($modelHumanNamePluralLowerCase, 'Basic ' . $modelHumanNamePluralLowerCase . ' information');?></p>
	</div>

	<div class="span12 colums">
	<?php
	echo $this->Form->create($model);
		?>
		<fieldset>
			<?php
			if($this->Form->value(sprintf('%s.id', $model))) {
				echo $this->Form->input('id');
			}

			foreach ($columns as $column => $settings) {
				if(is_array($settings)) {
					$fieldName = $column;
					$default = array(
						'label' => $fieldName
					);
					$settings = array_merge($default, $settings);
				} else {
					$fieldName = $settings;
					$settings = array('label' => __d($modelHumanNamePluralLowerCase, ucfirst($fieldName)));
				}

				if($fieldName == 'id') {
					throw new Exception('Input "id" already exists.');
				}

				// Change label to human readable
				$settings['label']	= pluginSplit($settings['label']); // We only want the "label" part
				$settings['label']	= Inflector::humanize(Inflector::underscore($settings['label'][1]));

				if (isset($settings['element']) && !empty($settings['element'])) {
					$pluginSplit = pluginSplit($settings['element']);
					echo $this->element($pluginSplit[1], array('field' => $fieldName), array('plugin' => $pluginSplit[0])); // @todo fix second array()
				} else {
					echo $this->Form->input($fieldName, $settings);
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