<?php

class Welcome extends BaseController {
	public function index() {
		echo "Welcome To PHP MVC.";
	}

	public function test() {
		$this->load->view('default/test', array(
			'title' => 'Test',
			'heading' => 'This is Test.'
		));
	}
}