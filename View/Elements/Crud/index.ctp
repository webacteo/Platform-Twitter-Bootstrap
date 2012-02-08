<?php
$modelHumanNameSingular = Inflector::humanize(Inflector::underscore($model)); // Project
$modelHumanNamePlural	= Inflector::pluralize($modelHumanNameSingular); // Projects

$baseUrl = array(
	'prefix'		=> Router::getParam('prefix'),
	'plugin'		=> Router::getParam('plugin'),
	'controller'	=> Router::getParam('controller'),
	'action'		=> Router::getParam('action')
);

$top_actions = array_merge(
	array(
		'10_create' => function($View, $modelHumanNameSingular, $baseUrl) { return $View->Html->link(__d('authentication', 'Create new %s', $modelHumanNameSingular), array('action' => 'add'), array('class' => 'btn success')); }
	),
	!empty($top_actions) ? $top_actions : array()
);
uksort($top_actions, 'strcmp');

$row_actions = array_merge(
	array(
		'10_view'	=> function($View, $item, $model, $baseUrl) { return $View->Html->link(__d('common', 'View'),		array('action' => 'view',	$item[$model]['id']) + $baseUrl, array('class' => 'btn'));			},
		'20_edit'	=> function($View, $item, $model, $baseUrl) { return $View->Html->link(__d('common', 'Edit'),		array('action' => 'edit',	$item[$model]['id']) + $baseUrl, array('class' => 'btn primary')); },
		'30_delete' => function($View, $item, $model, $baseUrl) { return $View->Form->postLink(__d('common', 'Delete'), array('action' => 'delete', $item[$model]['id']) + $baseUrl, array('class' => 'btn danger'));
}),
	!empty($row_actions) ? $row_actions : array()
);
uksort($row_actions, 'strcmp');
?>

<div class="page-header">
	<h1><?php echo __d('authentication', $modelHumanNamePlural)?> <small><?php echo __d('authentication', 'Manage %s', $modelHumanNamePlural);?></small></h1>
	<div class="page-header-actions">
		<?php
		foreach ($top_actions as $action) {
			if (is_callable($action)) {
				echo call_user_func($action, $this, $modelHumanNameSingular, $baseUrl);
			} else {
				echo $action;
			}
			echo '&nbsp;';
		}
		?>
	</div>
</div>

<?php
$this->Paginator->options(array('update' => '.content', 'evalScripts' => true));
?>

<table class="zebra-striped">
	<thead>
		<tr>
			<?php
			$columns = Set::normalize($columns);
			foreach ($columns as $column => $settings) {
				if (is_array($settings)) {
					$columnName = $settings['name'];
				} else {
					$columnName = $column;
				}

				// Change label to human readable
				$columnName = pluginSplit($columnName); // We only want the "label" part
				$columnName = Inflector::humanize(Inflector::underscore($columnName[1]));

				echo $this->Paginator->sortTableHeader($column, $columnName);
			}
			?>
			<th class="blue header" width="30%">Actions</th>
		</tr>
	</thead>

	<tbody>
		<?php
		foreach ($items as $item) {
			?>
			<tr>
				<?php
				foreach ($columns as $column => $settings) {
					?>
					<td>
						<?php
						// If dot notation
						if (strstr($column, '.')) {
							$entry = Set::extract($column, $item);
						} else {
							$entry = $item[$model][$column];
						}

						echo $entry;
						?>
					</td>
					<?php
				}
				?>
				<td>
					<?php
					foreach ($row_actions as $action) {
						if (is_callable($action)) {
							echo call_user_func($action, $this, $item, $model, $baseUrl);
						} else {
							echo $action;
						}
						echo '&nbsp;';
					}
					?>
				</td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>
<?php echo $this->element('Crud/pagination', array(), array('plugin' => 'TwitterBootstrap'));