<?php
defined('_EXEC') or die;

class Profile_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
		if(Session::getValue('level') > 8)
		{
            if(Format::existAjaxRequest() == true)
			{
                $username = isset($_POST['username']) ? $_POST['username'] : '';

                if(empty($username))
                    $message = 'Ingrese su nombre de usuario';

                if(!isset($message))
                {
                    $editProfile = $this->model->editProfile($username);

                    if(!empty($editProfile))
                    {
                        echo json_encode([
                            'status' => 'success'
                        ]);
                    }
                    else
                    {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Error al insertar el registro'
                        ]);
                    }
                }
                else
                {
                    echo json_encode([
                        'status' => 'error',
                        'message' => $message
                    ]);
                }
            }
            else
            {
                define('_title', 'LT | Administrador');

    	        $template = $this->view->render($this, 'index');
    	        $template = $this->format->replaceFile($template, 'topbar');
    	        $template = $this->format->replaceFile($template, 'sidebar');

                $profile = $this->model->getProfile();

    	        $replace = [
                    '{$username}' => $profile['username']
    	        ];

    	        $template = $this->format->replace($replace, $template);

    	        echo $template;
            }
		}
    }

	public function password()
    {
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
                $password				= (isset($_POST['password'])) ? $_POST['password'] : '';
    			$password_repeat		= (isset($_POST['password_repeat'])) ? $_POST['password_repeat'] : '';

    			if($password != $password_repeat)
    				$message = 'Las contraseñas no concuerdan';

    			if(empty($password_repeat))
    				$message = 'Repita su contraseña';

    			if(strlen($password) > 200)
    				$message = 'Contraseña demasiado larga';

    			if(empty($password))
    				$message = 'Ingrese su nueva contraseña';

    			if(!isset($message))
    			{
    				$password         = $this->security->createPassword($password);
    				$resetPassword    = $this->model->resetPassword($password);

    				if(!empty($resetPassword))
    				{
    					echo json_encode([
    						'status' => 'success'
    					]);
    				}
    				else
    				{
    					echo json_encode([
    						'status' => 'error',
    						'message' => 'Error to restart password'
    					]);
    				}
    			}
    			else
    			{
    				echo json_encode([
    					'status' => 'error',
    					'message' => $message
    				]);
    			}
			}
			else
			{
			    define('_title', 'LT | Administrador');

			    $template = $this->view->render($this, 'password');
			    $template = $this->format->replaceFile($template, 'topbar');
			    $template = $this->format->replaceFile($template, 'sidebar');

			    echo $template;
			}
		}
    }
}
