<?php
defined('_EXEC') or die;

class Comments_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
		if(Session::getValue('level') > 8)
		{
	        define('_title', 'LT | Administrador');

	        $template = $this->view->render($this, 'index');
	        $template = $this->format->replaceFile($template, 'topbar');
	        $template = $this->format->replaceFile($template, 'sidebar');

	        $comments = $this->model->getComments();

	        $commentsList = '';

	        foreach($comments as $comment)
	        {
	            $commentsList .=
	            '<tr>
					<td><input type="checkbox" data-check value="' . $comment['id_comment'] . '" /></td>
	                <td data-title="name">' . $comment['name'] . '</td>
	                <td data-title="comment">' . html_entity_decode($comment['description']) . '</td>
	                <td data-title="date">' . $comment['date'] . '</td>
					<td data-title="visible">' . (($comment['visible'] == true) ? '<span style="color:green;">Si</span>' : '<span style="color:red;">No</span>') . '</td>
					<td class="text-right">
						<a href="" data-action="visible" data-id="' . $comment['id_comment'] .'">' . (($comment['visible'] == true) ? '<i class="material-icons">close</i>' : '<i class="material-icons">check</i>') . '</a>
						<a href="index.php?c=comments&m=editComment&p=' . $comment['id_comment'] . '"><i class="material-icons">edit</i></a>
					</td>
	            </tr>';
	        }

	        $replace = [
	            '{$commentsList}' => $commentsList
	        ];

	        $template = $this->format->replace($replace, $template);

	        echo $template;
		}
    }

	public function editComment($id_comment)
    {
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$comment = isset($_POST["comment"]) ? $_POST["comment"] : "";

				if(empty($comment))
					$message = 'Ingrese una descripción';

				if(!isset($message))
				{
					$editComment = $this->model->editComment($id_comment, $comment);

					if(!empty($editComment))
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

			    $template = $this->view->render($this, 'editComment');
			    $template = $this->format->replaceFile($template, 'topbar');
			    $template = $this->format->replaceFile($template, 'sidebar');

				$comment = $this->model->getComment($id_comment);

			    $replace = [
					'{$comment}' => $comment['description'],
					'{$name}' => $comment['name'],
					'{$date}' => $comment['date']
			    ];

			    $template = $this->format->replace($replace, $template);

			    echo $template;
			}
		}
    }

	public function visibleComment()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$id = isset($_POST['id']) ? $_POST['id'] : '';

                $visibleComment = $this->model->visibleComment($id);

                if(!empty($visibleComment))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'Error al actualizar el registro'
					]);
				}
			}
		}
	}

	public function deleteComments()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$data = (isset($_POST['data']) AND !empty($_POST['data'])) ? $_POST['data'] : '';

				if(empty($data))
					$message = 'Seleccionar los comentarios a eliminar';

				if(!isset($message))
				{
					$data = json_decode($data);
					$data = $this->model->deleteComments($data);

					if(!empty($data))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'success',
							'message' => 'Error to delete entries'
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
		}
	}
}
