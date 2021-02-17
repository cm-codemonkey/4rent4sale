<?php
defined('_EXEC') or die;

class System
{
    private $security;

    public function __construct()
    {
        $this->security = new Security();
    }

    public function existsSession()
    {
        if(
            Session::existsVar('token') &&
            Session::existsVar('id_user') &&
            Session::existsVar('user') &&
            Session::existsVar('lastAccess') &&
            Session::existsVar('level') &&
            Session::getValue('level') >= 8
        )
        {
            $lastAccess = Session::getValue('lastAccess');
            $now = Format::getDateHour();
            $timeElapsed = ( strtotime( $now ) - strtotime( $lastAccess ) );

            if( $timeElapsed >= 3600 )
                return false;
            else
                return true;
        }
        else
            return false;
    }

    public function gotolocation($controller = false, $method = false, $params = false)
    {
        $url = $this->security->protocol() . $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
        $urlPart = explode(ADMINISTRATOR, $url);

        $url = $urlPart[0] . ADMINISTRATOR . '/';

        $controller = ( $controller != false )? '?c=' . $controller : '';
        $method     = ( $method != false )? '&m=' . $method : '';
        $params     = ( $params != false )? '&p=' . $params : '';

        header('Location: ' . $url . 'index.php' . $controller . $method . $params);
    }

    public function getLevel($level)
    {
        switch ($level)
        {
            case 1:
            case 2:
            case 3:
                $level = 'Registrado';
                break;

            case 4:
            case 5:
                $level = 'Autor';
                break;

            case 6:
                $level = 'Editor';
                break;

            case 7:
                $level = 'Publicador';
                break;

            case 8:
                $level = 'Gestor';
                break;

            case 9:
                $level = 'Administrador';
                break;

            case 10:
                $level = 'Super usuario';
                break;

            default:
                $level = 'unknown';
                break;
        }

        return $level;
    }
}
