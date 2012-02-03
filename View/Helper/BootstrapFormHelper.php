<?php
App::uses('FormHelper', 'View/Helper');
/**
 * Twitter Bootstrap Form Helper
 */
class BootstrapFormHelper extends FormHelper {

	/**
	* Build custom input field for Twitter Bootstrap support
	*
	* @param string $fieldName
	* @param array $options
	*
	* @return string
	*/
	public function input($fieldName, $options = array()) {
		$this->setEntity($fieldName);

		$defaults = array(
			'between'	=> '<div class="input">',
			'after'		=> '</div>',
			'format'	=> array('before', 'label', 'between', 'input', 'error', 'after'),
			'class'		=> 'span10',
			'div'		=> array(
				'class' => 'clearfix'
			),
			'error'		=> array(
				'attributes' => array(
					'class' => 'help-block error',
					'wrap'	=> 'span'
				)
			),
			'help'		=> '',
			'required'	=> false
		);

		$options = array_merge($defaults, $options);

		// Use TwitterBootstraps help block
		if (!empty($options['help'])) {
			$options['after'] = '<span class="help-block">' . $options['help'] . '</span>' . $options['after'];
		}

		$modelKey = $this->model();
		$fieldKey = $this->field();
		if ($options['required'] || $this->_introspectModel($modelKey, 'validates', $fieldKey)) {
			$options['label']		= $this->addClass($options['div'], 'label notice');
			$options['required']	= true; // HTML5 requirement
//			echo $fieldKey . ' : ';
//			print '<pre>';
//			var_dump($this->_introspectModel($modelKey, 'validates', $fieldKey));
//			print '</pre>';
//			return;
		}

		return parent::input($fieldName, $options);
	}


	/**
	 * Render error messages
	 *
	 * @param string $field
	 * @param mixed $text
	 * @param array $options
	 *
	 * @return string
	 */
	public function error($field, $text = null, $options = array()) {
		// The only way currently to catch Model Relation validation errors :(
		if ($field[0] == ucfirst($field[0])) {
			$field = sprintf('%s.%s', $this->_modelScope, $field);
		}

		return parent::error($field, $text, $options);
	}

	/**
	 * Submit button
	 *
	 * @param string $label
	 *
	 * @return string
	 */
	public function submit($label = null) {
		$options = array(
			'div'	=> 'actions',
			'class' => 'btn primary'
		);

		return parent::submit($label, $options);
	}
}