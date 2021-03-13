<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.models
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 03 - 19, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Módulo de revista.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Magazine_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_magazine_articles($author = null)
	{
		if (isset($author) AND !empty($author))
		{
			$query = $this->database->select('magazine', [
				'[>]users' => ['id_user' => 'id_user']
			], [
				'magazine.id_magazine_article',
				'magazine.name',
				'magazine.date',
				'magazine.background',
				'users.fullname(author)',
				'magazine.priority'
			], [
				'magazine.id_user' => $author
			]);
		}
		else
		{
			$query = $this->database->select('magazine', [
				'[>]users' => ['id_user' => 'id_user']
			], [
				'magazine.id_magazine_article',
				'magazine.name',
				'magazine.date',
				'magazine.background',
				'users.fullname(author)',
				'magazine.priority'
			]);
		}

		return $query;
	}

	public function get_magazine_article_by_id($id_magazine_article)
	{
		$query = $this->database->select('magazine', '*', [
			'id_magazine_article' => $id_magazine_article
		]);

		return !empty($query) ? $query[0] : null;
	}

	public function get_magazine_article_gallery($id_magazine_article)
	{
		$query = $this->database->select('gallery', [
			'id_gallery_image',
			'name'
		], [
			'id_magazine_article' => $id_magazine_article,
			'ORDER' => [
				'id_magazine_article' => 'DESC'
			]
		]);

		return $query;
	}

	public function get_subscriptions()
	{
		$query = $this->database->select('subscriptions', [
			'email'
		]);

		return $query;
	}

	public function get_contact()
	{
		$query = $this->database->select('contact', [
			'email'
		]);

		return !empty($query) ? $query[0] : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */
	public function new_magazine_article($magazine_article)
	{
		$this->component->load_component('uploader');

		$_com_uploader = new Upload;
		$_com_uploader->SetFileName($magazine_article['background']['name']);
		$_com_uploader->SetTempName($magazine_article['background']['tmp_name']);
		$_com_uploader->SetFileType($magazine_article['background']['type']);
		$_com_uploader->SetFileSize($magazine_article['background']['size']);
		$_com_uploader->SetUploadDirectory(PATH_IMAGES . 'magazine');
		$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
		$_com_uploader->SetMaximumFileSize('unlimited');

		$magazine_article['background'] = $_com_uploader->UploadFile();

		if (isset($magazine_article['priority']) AND !empty($magazine_article['priority']))
		{
			$this->database->update('magazine', [
				'priority' => null
			], [
				'priority' => $magazine_article['priority']
			]);
		}

		if ($magazine_article['background']['status'] == 'success')
		{
			$magazine_article['background'] = $magazine_article['background']['file'];

			$query = $this->database->insert('magazine', [
				'name' => $magazine_article['name'],
				'description' => $magazine_article['description'],
				'date' =>  date('Y-m-d'),
				'background' => $magazine_article['background'],
				'id_user' => Session::get_value('_vkye_id_user'),
				'priority' => $magazine_article['priority']
			]);

            return !empty($query) ? $this->database->id($query) : null;
		}
		else
			return null;
	}

	public function new_gallery_image($name, $id_magazine_article)
	{
		$query = $this->database->insert('gallery', [
			'name' => $name,
			'id_magazine_article' => $id_magazine_article
		]);

		return $query;
	}

	/* Updates
	------------------------------------------------------------------------------- */
	public function edit_magazine_article($magazine_article)
	{
		if (isset($magazine_article['background']) AND !empty($magazine_article['background']))
		{
			$this->component->load_component('uploader');

			$_com_uploader = new Upload;
			$_com_uploader->SetFileName($magazine_article['background']['name']);
			$_com_uploader->SetTempName($magazine_article['background']['tmp_name']);
			$_com_uploader->SetFileType($magazine_article['background']['type']);
			$_com_uploader->SetFileSize($magazine_article['background']['size']);
			$_com_uploader->SetUploadDirectory(PATH_IMAGES . 'magazine');
			$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
			$_com_uploader->SetMaximumFileSize('unlimited');

			$magazine_article['background'] = $_com_uploader->UploadFile();
		}

        if (!isset($magazine_article['background']) OR $magazine_article['background']['status'] == 'success')
		{
			if (!isset($magazine_article['background']))
			{
				$edited = $this->database->select('magazine', ['background'], ['id_magazine_article' => $magazine_article['id_magazine_article']]);
				$magazine_article['background'] = !empty($edited[0]['background']) ? $edited[0]['background'] : null;
			}
			else if ($magazine_article['background']['status'] == 'success')
				$magazine_article['background'] = $magazine_article['background']['file'];

			if (isset($magazine_article['priority']) AND !empty($magazine_article['priority']))
			{
				$this->database->update('magazine', [
					'priority' => null
				], [
					'priority' => $magazine_article['priority']
				]);
			}

			$query = $this->database->update('magazine', [
				'name' => $magazine_article['name'],
				'description' => $magazine_article['description'],
				'background' => $magazine_article['background'],
				'priority' => $magazine_article['priority']
			], [
				'id_magazine_article' => $magazine_article['id_magazine_article']
			]);

            return $query;
		}
		else
			return null;
	}

	/* Deletes
	------------------------------------------------------------------------------- */
	public function delete_magazine_articles($selection)
    {
		$query = $this->database->delete('gallery', [
			'id_magazine_article' => $selection
		]);

		$query = $this->database->delete('magazine', [
            'id_magazine_article' => $selection
        ]);

        return $query;
    }

	public function delete_gallery_image($id_gallery_image)
	{
		$query = $this->database->delete('gallery', [
			'id_gallery_image' => $id_gallery_image
		]);

		return $query;
	}

	/* Others
	------------------------------------------------------------------------------- */
	public function uploader($src, $path = PATH_IMAGES)
	{
		list($type, $src)	= explode(';', $src);
		list(, $src)		= explode(',', $src);
		$src				= base64_decode($src);
		$name				= $this->security->random_string(32) . '.png';
		$file				= $path . $name;
		$success			= file_put_contents($file, $src);

		return $name;
	}
}
