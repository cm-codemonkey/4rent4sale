<?php
defined('_EXEC') or die;

class System_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->login();
	}

	public function login()
	{
		if($this->system->existsSession() === true)
			$this->system->gotolocation('Index');

		/* Action Ajax ------------------------------------------------------ */
		if(Format::existAjaxRequest() == true)
		{
			if(isset($_POST))
			{
				$user = ( isset( $_POST['user'] ) ) ? $_POST['user'] : '';
				$password = ( isset( $_POST['password'] ) ) ? $_POST['password'] : '';
				$this->model->login( $user, $password );
			}
		}
		else
		{
			define('_title', 'Iniciar Sesion - Panel de Control');
			$template = $this->view->render($this, 'login');

			echo $template;
		}
	}

	public function logout()
	{
		Session::destroy();
		$this->system->gotolocation();
	}

}
