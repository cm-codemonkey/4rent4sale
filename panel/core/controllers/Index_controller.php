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

	public function test()
	{
		if (Format::existAjaxRequest() == true)
		{
			require_once PATH_ADMINISTRATOR_COMPONENTS . '/Upload/Upload.class.php';

			$config_uploads = [
				'extensions' => [ 'images' => ['jpg', 'jpeg', 'png'] ],
				'path_uploads' => PATH_UPLOADS,
				'set_name' => 'FILE_NAME_LAST_RANDOM'
			];

			$post['gallery'] = ( isset($_FILES['gallery']) && !empty($_FILES['gallery']) ) ? Upload::order_array($_FILES['gallery']) : null;

			if ( !empty($post['gallery']) )
			/*  */ $post['gallery'] = Upload::upload_array($post['gallery'], $config_uploads);
			else
			/*  */ $post['gallery'] = null;

			print_r($post['gallery']);
		}
		else
		{
			echo $this->view->render($this, 'test');
		}
	}

}
