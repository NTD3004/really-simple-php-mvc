<?php

class Welcome extends BaseController {
	public function index() {
		echo "Welcome To PHP MVC.";
	}

	public function foo() {
		$this->load->view('default/foo', array(
			'title' => 'Foo',
			'heading' => 'This is Foo.'
		));
	}
}