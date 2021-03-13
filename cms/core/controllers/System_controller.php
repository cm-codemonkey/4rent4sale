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
		/* Action Ajax ------------------------------------------------------ */
		if ( Format::exist_ajax_request() )
		{
			$_POST['action'] = ( isset($_POST['action']) ) ? $_POST['action'] : 'default';

			switch ( $_POST['action'] )
			{
				case 'login':
				default:
					$post['username'] =
						( isset($_POST['username']) && !empty($_POST['username']) ) ? $_POST['username'] : null;
					$post['password'] =
						( isset($_POST['password']) && !empty($_POST['password']) ) ? $_POST['password'] : null;

					$labels = [];

					if ( is_null($post['username']) )
						array_push($labels, ['username', 'Por favor, escriba un nombre de usuario o el correo electrónico.']);

					if ( is_null($post['password']) )
						array_push($labels, ['password', 'Por favor, escriba una contraseña.']);

					if ( empty($labels) )
					{
						$this->model->login($post);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'labels' => $labels
						]);
					}

					break;
			}
		}
		else
		{
			if ( $this->system->exists_session() )
				$this->system->go_to_location('Index');

			define('_title', '{$lang.title}');

			$template = $this->view->render($this, [
				'head' => [
					"path" => PATH_ADMINISTRATOR_LAYOUTS . "Login",
					"file" => "head"
				],
				'main' => [
					"path" => PATH_ADMINISTRATOR_LAYOUTS . "Login",
					"file" => "index"
				],
				'footer' => [
					"path" => PATH_ADMINISTRATOR_LAYOUTS . "Login",
					"file" => "footer"
				]
			]);

			echo $template;
		}
	}

	public function logout()
	{
		Session::destroy();
		$this->system->go_to_location();
	}

}
