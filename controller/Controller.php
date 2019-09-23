<?php
class Controller 
{
	public function render() {
		ob_start();
		$data = $this->_data;
		require($this->_view);
		return ob_get_clean();
	}

	public function getModel() {
		return $this->_model;
	}
}