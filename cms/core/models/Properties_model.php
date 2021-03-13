<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.controllers
*
* @author Julian Alberto Canche Dzib <Developer, jcanche@codemonkey.com.mx>
* @since October 22 / October 30, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Módulo de propiedades.
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since October 30 / November 14, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Se integrarón las funciones de new_property_details, edit_property_details y delete_property_details. Se actualizarón las funciones de new_property y edit_property para integrar la funcionalidad de propiedades multiples y sencillas.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Properties_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_properties()
	{
		$query = $this->database->select('properties', [
			'[>]properties_categories' => ['id_property_category' => 'id_property_category'],
			'[>]properties_locations' => ['id_property_location' => 'id_property_location']
		], [
			'properties.id_property',
			'properties.name',
			'properties.type',
			'properties.details',
			'properties_categories.name(category)',
			'properties_locations.name(location)',
			'properties.background',
			'properties.priority'
		]);

		return $query;
	}

	public function get_property_by_id($id_property)
	{
		$query = $this->database->select('properties', '*', [
			'id_property' => $id_property
		]);

		return !empty($query) ? $query[0] : null;
	}

	public function get_properties_categories()
	{
		$query = $this->database->select('properties_categories', [
			'id_property_category',
			'name',
			'background',
			'priority'
		]);

		return $query;
	}

	public function get_property_category_by_id($id_property_category)
	{
		$query = $this->database->select('properties_categories', [
			'id_property_category',
			'name',
			'background',
			'priority'
		], [
			'id_property_category' => $id_property_category
		]);

		return $query[0];
	}

	public function get_properties_locations()
	{
		$query = $this->database->select('properties_locations', [
			'id_property_location',
			'name'
		]);

		return $query;
	}

	public function get_property_location_by_id($id_property_location)
	{
		$query = $this->database->select('properties_locations', [
			'id_property_location',
			'name'
		], [
			'id_property_location' => $id_property_location
		]);

		return $query[0];
	}

	public function get_property_gallery($id_property)
	{
		$query = $this->database->select('gallery', [
			'id_gallery_image',
			'name'
		], [
			'id_property' => $id_property,
			'ORDER' => [
				'id_gallery_image' => 'DESC'
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

		return !empty($query) ? $query : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */
	public function new_property($property)
	{
		$this->component->load_component('uploader');

		$_com_uploader = new Upload;
		$_com_uploader->SetFileName($property['background']['name']);
		$_com_uploader->SetTempName($property['background']['tmp_name']);
		$_com_uploader->SetFileType($property['background']['type']);
		$_com_uploader->SetFileSize($property['background']['size']);
		$_com_uploader->SetUploadDirectory(PATH_IMAGES . 'properties');
		$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
		$_com_uploader->SetMaximumFileSize('unlimited');

		$property['background'] = $_com_uploader->UploadFile();

		if ($property['background']['status'] == 'success')
		{
			$property['background'] = $property['background']['file'];

			if (isset($property['priority']) AND !empty($property['priority']))
			{
				$this->database->update('properties', [
					'priority' => null
				], [
					'priority' => $property['priority']
				]);
			}

			$query = $this->database->insert('properties', [
				'name' => $property['name'],
				'description' => $property['description'],
				'type' => $property['type'],
				'details' => $property['details'],
				'map' => $property['map'],
				'id_property_category' => $property['id_property_category'],
				'id_property_location' => $property['id_property_location'],
				'background' => $property['background'],
				'pdf' => $property['pdf'],
				'priority' => $property['priority']
			]);

			return !empty($query) ? $this->database->id($query) : null;
		}
		else
			return null;
	}

	public function new_property_details($details)
	{
		$this->component->load_component('uploader');

		$_com_uploader = new Upload;
		$_com_uploader->SetFileName($details['background']['name']);
		$_com_uploader->SetTempName($details['background']['tmp_name']);
		$_com_uploader->SetFileType($details['background']['type']);
		$_com_uploader->SetFileSize($details['background']['size']);
		$_com_uploader->SetUploadDirectory(PATH_IMAGES . 'properties');
		$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
		$_com_uploader->SetMaximumFileSize('unlimited');

		$details['background'] = $_com_uploader->UploadFile();

		if ($details['background']['status'] == 'success')
		{
			$details['background'] = $details['background']['file'];

			array_push($details['details'], [
				'position' => $details['position'],
				'name' => [
					'es' => $details['name']['es'],
					'en' => $details['name']['en'],
				],
				'price' => $details['price'],
				'dimensions' => [
					'es' => $details['dimensions']['es'],
					'en' => $details['dimensions']['en']
				],
				'characteristics' => $details['characteristics'],
				'amenities' => $details['amenities'],
				'available' => $details['available'],
				'type' => $details['type'],
				'background' => $details['background']
			]);

			foreach ($details['details'] as $key => $row)
				$aux[$key] = $row['position'];

			array_multisort($aux, SORT_ASC, $details['details']);

			$query = $this->database->update('properties', [
				'details' => json_encode($details['details'])
			], [
				'id_property' => $details['id_property']
			]);

			return $query;
		}
		else
			return null;
	}

	public function new_property_category($category)
	{
		$this->component->load_component('uploader');

		$_com_uploader = new Upload;
		$_com_uploader->SetFileName($category['background']['name']);
		$_com_uploader->SetTempName($category['background']['tmp_name']);
		$_com_uploader->SetFileType($category['background']['type']);
		$_com_uploader->SetFileSize($category['background']['size']);
		$_com_uploader->SetUploadDirectory(PATH_IMAGES . '/properties/categories');
		$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
		$_com_uploader->SetMaximumFileSize('unlimited');

		$category['background'] = $_com_uploader->UploadFile();

		if ($category['background']['status'] == 'success')
		{
			$category['background'] = $category['background']['file'];

			if (isset($category['priority']) AND !empty($category['priority']))
			{
				$this->database->update('properties_categories', [
					'priority' => null
				], [
					'priority' => $category['priority']
				]);
			}

			$query = $this->database->insert('properties_categories', [
				'name' => $category['name'],
				'background' => $category['background'],
				'priority' => $category['priority']
			]);

			return $query;
		}
		else
			return null;
	}

	public function new_property_location($location)
	{
		$query = $this->database->insert('properties_locations', [
			'name' => $location['name']
		]);

		return $query;
	}

	public function new_gallery_image($name, $id_property)
	{
		$query = $this->database->insert('gallery', [
			'name' => $name,
			'id_property' => $id_property
		]);

		return $query;
	}

	/* Updates
	------------------------------------------------------------------------------- */
	public function edit_property($property)
	{
		if (isset($property['background']) AND !empty($property['background']))
		{
			$this->component->load_component('uploader');

			$_com_uploader = new Upload;
			$_com_uploader->SetFileName($property['background']['name']);
			$_com_uploader->SetTempName($property['background']['tmp_name']);
			$_com_uploader->SetFileType($property['background']['type']);
			$_com_uploader->SetFileSize($property['background']['size']);
			$_com_uploader->SetUploadDirectory(PATH_IMAGES . '/properties');
			$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
			$_com_uploader->SetMaximumFileSize('unlimited');

			$property['background'] = $_com_uploader->UploadFile();
		}

		if (!isset($property['background']) OR $property['background']['status'] == 'success')
		{
			$edited = $this->database->select('properties', ['type', 'details', 'background', 'pdf'], ['id_property' => $property['id_property']]);

			if ($property['type'] == 'multiple' AND $edited[0]['type'] == 'multiple')
				$property['details'] = $edited[0]['details'];

			if (!isset($property['background']))
				$property['background'] = !empty($edited[0]['background']) ? $edited[0]['background'] : null;
			else if ($property['background']['status'] == 'success')
				$property['background'] = $property['background']['file'];

			if (!isset($property['pdf']))
				$property['pdf'] = !empty($edited[0]['pdf']) ? $edited[0]['pdf'] : null;

			if (isset($property['priority']) AND !empty($property['priority']))
			{
				$this->database->update('properties', [
					'priority' => null
				], [
					'priority' => $property['priority']
				]);
			}

			$query = $this->database->update('properties', [
				'name' => $property['name'],
				'description' => $property['description'],
				'type' => $property['type'],
				'details' => $property['details'],
				'map' => $property['map'],
				'id_property_category' => $property['id_property_category'],
				'id_property_location' => $property['id_property_location'],
				'background' => $property['background'],
				'pdf' => $property['pdf'],
				'priority' => $property['priority']
			], [
				'id_property' => $property['id_property']
			]);

			return $query;
		}
		else
			return null;
	}

	public function edit_property_details($details)
	{
		if (isset($details['background']) AND !empty($details['background']))
		{
			$this->component->load_component('uploader');

			$_com_uploader = new Upload;
			$_com_uploader->SetFileName($details['background']['name']);
			$_com_uploader->SetTempName($details['background']['tmp_name']);
			$_com_uploader->SetFileType($details['background']['type']);
			$_com_uploader->SetFileSize($details['background']['size']);
			$_com_uploader->SetUploadDirectory(PATH_IMAGES . 'properties');
			$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
			$_com_uploader->SetMaximumFileSize('unlimited');

			$details['background'] = $_com_uploader->UploadFile();
		}

		if (!isset($details['background']) OR $details['background']['status'] == 'success')
		{
			if (!isset($details['background']))
				$details['background'] = (!empty($details['details'][$details['id_details']]['background'])) ? $details['details'][$details['id_details']]['background'] : null;
			else if ($details['background']['status'] == 'success')
				$details['background'] = $details['background']['file'];

			$details['details'][$details['id_details']] = [
				'position' => $details['position'],
				'name' => [
					'es' => $details['name']['es'],
					'en' => $details['name']['en'],
				],
				'price' => $details['price'],
				'dimensions' => [
					'es' => $details['dimensions']['es'],
					'en' => $details['dimensions']['en']
				],
				'characteristics' => $details['characteristics'],
				'amenities' => $details['amenities'],
				'available' => $details['available'],
				'type' => $details['type'],
				'background' => $details['background']
			];

			foreach ($details['details'] as $key => $row)
				$aux[$key] = $row['position'];

			array_multisort($aux, SORT_ASC, $details['details']);

			$query = $this->database->update('properties', [
				'details' => json_encode($details['details'])
			], [
				'id_property' => $details['id_property']
			]);

			return $query;
		}
		else
			return null;
	}

	public function edit_property_category($category)
	{
		if (isset($category['background']) AND !empty($category['background']))
		{
			$this->component->load_component('uploader');

			$_com_uploader = new Upload;
			$_com_uploader->SetFileName($category['background']['name']);
			$_com_uploader->SetTempName($category['background']['tmp_name']);
			$_com_uploader->SetFileType($category['background']['type']);
			$_com_uploader->SetFileSize($category['background']['size']);
			$_com_uploader->SetUploadDirectory(PATH_IMAGES . '/properties/categories');
			$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
			$_com_uploader->SetMaximumFileSize('unlimited');

			$category['background'] = $_com_uploader->UploadFile();
		}

		if (!isset($category['background']) OR $category['background']['status'] == 'success')
		{
			if (!isset($category['background']))
			{
				$edited = $this->database->select('properties_categories', ['background'], ['id_property_category' => $category['id_property_category']]);
				$category['background'] = (isset($edited['background']) AND !empty($edited['background'])) ? $edited['background'] : null;
			}
			else if ($category['background']['status'] == 'success')
				$category['background'] = $category['background']['file'];

			if (isset($category['priority']) AND !empty($category['priority']))
			{
				$this->database->update('properties_categories', [
					'priority' => null
				], [
					'priority' => $category['priority']
				]);
			}

			$query = $this->database->update('properties_categories', [
				'name' => $category['name'],
				'background' => $category['background'],
				'priority' => $category['priority']
			], [
				'id_property_category' => $category['id_property_category']
			]);

			return $query;
		}
		else
			return null;
	}

	public function edit_property_location($location)
	{
		$query = $this->database->update('properties_locations', [
			'name' => $location['name']
		], [
			'id_property_location' => $location['id_property_location']
		]);

		return $query;
	}

	/* Deletes
	------------------------------------------------------------------------------- */
	public function delete_properties($selection)
	{
		$query = $this->database->delete('gallery', [
			'id_property' => $selection
		]);

		$query = $this->database->delete('properties', [
			'id_property' => $selection
		]);

		return $query;
	}

	public function delete_property_details($id_property, $details)
	{
		$query = $this->database->update('properties', [
			'details' => $details
		], [
			'id_property' => $id_property
		]);

		return $query;
	}

	public function delete_categories($selection)
	{
		$query = $this->database->delete('properties_categories', [
			'id_property_category' => $selection
		]);

		return $query;
	}

	public function delete_locations($selection)
	{
		$query = $this->database->delete('properties_locations', [
			'id_property_location' => $selection
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
	public function uploader($src, $path = PATH_IMAGES, $ext = '.png')
	{
		list($type, $src)	= explode(';', $src);
		list(, $src)		= explode(',', $src);
		$src				= base64_decode($src);
		$name				= $this->security->random_string(32) . $ext;
		$file				= $path . $name;
		$success			= file_put_contents($file, $src);

		return $name;
	}
}
