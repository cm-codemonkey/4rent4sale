<?php
defined('_EXEC') or die;

class Subscriptions_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        define('_title', 'LT | Administrador');

        $template = $this->view->render($this, 'index');
        $template = $this->format->replaceFile($template, 'topbar');
        $template = $this->format->replaceFile($template, 'sidebar');

        $subscriptions = $this->model->getSubscriptions();

        $subscriptionsList = '';

        foreach($subscriptions as $subscription)
        {
            $subscriptionsList .=
            '<tr>
                <td data-title="name">' . $subscription['name'] . '</td>
                <td data-title="email">' . $subscription['email'] . '</td>
                <td data-title="date">' . $subscription['date'] . '</td>
            </tr>';
        }

        $replace = [
            '{$subscriptionsList}' => $subscriptionsList
        ];

        $template = $this->format->replace($replace, $template);

        echo $template;
    }
}
