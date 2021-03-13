<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.models
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create properties model
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 29, 2018 <1.0.0> <@update>
* Crear funcion de get_contact
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

			$query1 = $this->database->select('properties', [
				'[>]properties_categories' => ['id_property_category' => 'id_property_category'],
				'[>]properties_locations' => ['id_property_location' => 'id_property_location']
			], [
				'properties.id_property',
				'properties.name',
				'properties.details',
				'properties_categories.name(category)',
				'properties_locations.name(location)',
				'properties.background',
				'properties.priority'
			], [
				'AND' => [
					$filter_location_1 => $filter_location_2,
					$filter_category_1 => $filter_category_2,
					'properties.priority[>=]' => 1
				],
				'ORDER' => [
					'properties.priority' => 'ASC'
				]
			]);

			$query2 = $this->database->select('properties', [
				'[>]properties_categories' => ['id_property_category' => 'id_property_category'],
				'[>]properties_locations' => ['id_property_location' => 'id_property_location']
			], [
				'properties.id_property',
				'properties.name',
				'properties.details',
				'properties_categories.name(category)',
				'properties_locations.name(location)',
				'properties.background',
				'properties.priority'
			], [
				'AND' => [
					$filter_location_1 => $filter_location_2,
					$filter_category_1 => $filter_category_2,
					'properties.priority[=]' => null
				]
			]);

			if ($filter['price'] == 'rank' OR $filter['type'] == 'sale' OR $filter['type'] == 'rent')
			{
				foreach ($query1 as $property1)
				{
					$filter_details = json_decode($property1['details'], true);

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
						array_push($array, $property1);
				}

				foreach ($query2 as $property2)
				{
					$filter_details = json_decode($property2['details'], true);

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
							if ($details['type'] == $filter['type'])
								$filter_details_type_permitted = true;
						}
						else
							$filter_details_type_permitted = true;
					}

					if ($filter_details_price_permitted == true AND $filter_details_type_permitted == true)
						array_push($array, $property2);
				}
			}
			else
			{
				foreach ($query1 as $property1)
					array_push($array, $property1);

				foreach ($query2 as $property2)
					array_push($array, $property2);
			}
		}
		else
		{
			$query1 = $this->database->select('properties', [
				'[>]properties_categories' => ['id_property_category' => 'id_property_category'],
				'[>]properties_locations' => ['id_property_location' => 'id_property_location']
			], [
				'properties.id_property',
				'properties.name',
				'properties.details',
				'properties_categories.name(category)',
				'properties_locations.name(location)',
				'properties.background',
				'properties.priority'
			], [
				'properties.priority[>=]' => 1,
				'ORDER' => [
					'properties.priority' => 'ASC'
				]
			]);

			$query2 = $this->database->select('properties', [
				'[>]properties_categories' => ['id_property_category' => 'id_property_category'],
				'[>]properties_locations' => ['id_property_location' => 'id_property_location']
			], [
				'properties.id_property',
				'properties.name',
				'properties.details',
				'properties_categories.name(category)',
				'properties_locations.name(location)',
				'properties.background',
				'properties.priority'
			], [
				'properties.priority[=]' => null
			]);

			foreach ($query1 as $property1)
				array_push($array, $property1);

			foreach ($query2 as $property2)
				array_push($array, $property2);
		}

		return $array;
	}

	public function get_property_by_id($id_property)
	{
		$query = $this->database->select('properties', [
			'[>]properties_categories' => ['id_property_category' => 'id_property_category'],
			'[>]properties_locations' => ['id_property_location' => 'id_property_location']
		], [
			'properties.id_property',
			'properties.name',
			'properties.description',
			'properties.details',
			'properties.map',
			'properties_categories.name(category)',
			'properties_locations.name(location)',
			'properties.background',
			'properties.pdf',
			'properties.priority'
		], [
			'properties.id_property' => $id_property
		]);

		return !empty($query) ? $query[0] : null;
	}

	public function get_property_gallery($id_property)
	{
		$query = $this->database->select('gallery', '*', [
			'id_property' => $id_property
		]);

		return $query;
	}

	public function get_settings()
	{
		$query = $this->database->select('settings', [
			'titles',
			'backgrounds'
		]);

		return !empty($query[0]) ? $query[0] : null;
	}

	public function get_contact()
	{
		$query = $this->database->select('contact', '*');
		return !empty($query) ? $query[0] : null;
	}

	public function get_locations()
	{
		$query = $this->database->select('properties_locations', [
			'id_property_location',
			'name'
		]);

		return $query;
	}

	public function get_categories()
	{
		$query = $this->database->select('properties_categories', [
			'id_property_category',
			'name'
		]);

		return $query;
	}

	/* Inserts
	------------------------------------------------------------------------------- */

	/* Updates
	------------------------------------------------------------------------------- */

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */

}
