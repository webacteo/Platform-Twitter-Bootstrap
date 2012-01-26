<?php
App::uses('PaginatorHelper', 'View/Helper');
/**
 * Twitter Bootstrap Paginator Helper
 */
class BootstrapPaginatorHelper extends PaginatorHelper {

	/**
	 * Make table headers sortable
	 *
	 * @param string $key
	 * @param mixed $title
	 * @param array $options
	 *
	 * @return string
	 */
	public function sortTableHeader($key, $title = null, $options = array()) {
		$content = parent::sort($key, $title, $options);

		$options = array_merge(array('url' => array(), 'model' => null), $options);

		$class = "";

		$sortKey = $this->sortKey($options['model']);
		$defaultModel = $this->defaultModel();
		$isSorted = (
			$sortKey === $key ||
			$sortKey === $defaultModel . '.' . $key ||
			$key === $defaultModel . '.' . $sortKey
		);

		if ($isSorted) {
			$dir = $this->sortDir($options['model']) === 'asc' ? 'desc' : 'asc';
			$class = ($dir === 'asc') ? 'headerSortDown' : 'headerSortUp';
		}

		return sprintf('<th class="blue header %s">%s</th>', $class, $content);
	}
}