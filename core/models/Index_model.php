<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.models
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 24-25, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Datos dinámico de categories. Datos dinámico de titulo, subtitulo y slideshow.
*
* @author Gersón Aarón Gómez Macías <Developer, ggomez@codemonkey.com.mx>
* @since October 30, 2018 <1.0.0> <@update>
* @summary Se corrigierón errores de estructura y programación.
*
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Index_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_settings()
	{
		$query = $this->database->select('settings', [
			'titles',
			'backgrounds'
		]);

		return !empty($query[0]) ? $query[0] : null;
	}

	public function get_categories($filter = false)
	{
		if ($filter == false)
		{
			$query = $this->database->select('properties_categories', [
				'id_property_category',
				'name',
				'background'
			], [
				'priority' => [1,2,3,4],
				'ORDER' => ['priority' => 'ASC'],
				'LIMIT' => 4
			]);
		}
		else
		{
			$query = $this->database->select('properties_categories', [
				'id_property_category',
				'name'
			]);
		}

		return $query;
	}

	public function get_locations()
	{
		$query = $this->database->select('properties_locations', [
			'id_property_location',
			'name'
		]);

		return $query;
	}

	public function get_properties($filter = null)
	{
		$array = [];

		if (isset($filter) AND !empty($filter))
		{
			$filter_location_1 = 'properties.id_property_location[>=]';
			$filter_location_2 = 1;
			$filter_category_1 = 'properties.id_property_category[>=]';
			$filter_category_2 = 1;

			if ($filter['location'] != 'all')
			{
				$filter_location_1 = 'properties.id_property_location';
				$filter_location_2 = $filter['location'];
			}

			if ($filter['category'] != 'all')
			{
				$filter_category_1 = 'properties.id_property_category';
				$filter_category_2 = $filter['category'];
			}

			$query = $this->database->select('properties', [
				'name',
				'details',
				'map'
			], [
				'AND' => [
					$filter_location_1 => $filter_location_2,
					$filter_category_1 => $filter_category_2
				]
			]);

			if ($filter['price'] == 'rank' OR $filter['type'] == 'sale' OR $filter['type'] == 'rent')
			{
				foreach ($query as $property)
				{
					$filter_details = json_decode($property['details'], true);

					$filter_details_price_permitted = false;
					$filter_details_type_permitted = false;

					foreach ($filter_details as $details)
					{
						if ($filter['price'] == 'rank')
						{
							if ($filter['price_from'] <= $details['price'] AND $filter['price_to'] >= $details['price'])
								$filter_details_price_permitted = true;
						}
						else
							$filter_details_price_permitted = true;

						if ($filter['type'] == 'sale' OR $filter['type'] == 'rent')
						{
							if ($filter['type'] == 'sale' AND $details['type'] == 'sale')
								$filter_details_type_permitted = true;
							else if ($filter['type'] == 'rent' AND $details['type'] == 'rent')
								$filter_details_type_permitted = true;
						}
						else
							$filter_details_type_permitted = true;
					}

					if ($filter_details_price_permitted == true AND $filter_details_type_permitted == true)
						array_push($array, $property);
				}
			}
			else
			{
				foreach ($query as $property)
					array_push($array, $property);
			}
		}
		else
		{
			$query = $this->database->select('properties', [
				'name',
				'map'
			], [
				'priority[>=]' => 1
			]);

			foreach ($query as $property)
				array_push($array, $property);
		}

		return $array;
	}

	public function get_magazine_articles()
	{
		$query = $this->database->select('magazine', [
			'id_magazine_article',
			'name',
			'date',
			'background'
		], [
			'priority' => [1,2,3],
			'ORDER' => ['priority' => 'ASC'],
			'LIMIT' => 3
		]);

		return $query;
	}

	public function get_contact()
	{
		$query = $this->database->select('contact', [
			'email',
			'social_media'
		]);

		return !empty($query) ? $query[0] : null;
	}

	public function get_exist_subscription($email)
	{
		$query = $this->database->select('subscriptions', [
			'id_subscription'
		], [
			'email' => $email
		]);

		return $query;
	}

	/* Inserts
	------------------------------------------------------------------------------- */
	public function new_subscription($subscription)
	{
		$query = $this->database->insert('subscriptions', [
			'fullname' => $subscription['fullname'],
			'email' => $subscription['email']
		]);

		return $query;
	}

	/* Updates
	------------------------------------------------------------------------------- */

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */

}
