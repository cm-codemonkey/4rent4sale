<?php
defined('_EXEC') or die;

class Index_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// $template = $this->view->render($this, 'index');
		// $template = $this->format->replaceFile($template, 'topbar');
		// $template = $this->format->replaceFile($template, 'sidebar');
		//
		// echo $template;
		header('Location: index.php?c=properties');
	}

}
