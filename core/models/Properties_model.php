<?php defined('_EXEC') or die;

class Properties_model extends Model
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = $_COOKIE['lang'];
	}

	public function getMetadata()
	{
		$response = $this->database->select('metadata', [
			'description',
			'keywords'
		], [
			'ORDER' => 'id_metadata DESC',
			'LIMIT' => 1
		]);

		if ( isset($response[0]) && !empty($response[0]) )
			return $response[0];
		else
			return null;
	}

	public function getLocations()
	{
		return $this->database->select('properties_locations', 'title', [
			'properties' => true,
			'ORDER' => 'title ASC'
		]);

		return $query;
	}

	public function getOptProyects()
	{
		$query = $this->database->select('properties', 'title', [
			'ORDER' => 'title ASC'
		]);

		$html = '';

		foreach ($query as $value)
			$html .= '<option value="' . $value . '">' . $value . '</option>';

		return $html;
	}

	public function getHtmlLocations()
	{
		$inputs = '';

		foreach ($this->getLocations() as $location)
		{
			$place = str_replace('_', ' ', ucwords($location));
			$inputs .= '<label><input name="location" value="'. str_replace(' ', '_', strtolower($location)) .'" type="checkbox"/> '. $place .'</label>';
		}

		return $inputs;
	}

	public function getHtmlCategories()
	{
		$inputs = '';

		$categories = $this->database->select('properties_categories', '*', [
			'ORDER' => 'title ASC'
		]);

		foreach ($categories as $category)
		{
			$category = json_decode($category['title'], true)[$this->lang];
			$name = str_replace('_', ' ', ucwords($category));
			$inputs .= '<label><input name="category" value="'. str_replace(' ', '_', strtolower($category)) .'" type="checkbox"/> '. $name .'</label>';
		}

		return $inputs;
	}

	public function shortenText($text, $length)
	{
		$shortenText = substr(strip_tags($text), 0, $length);

		if (strlen(strip_tags($text)) > $length)
			$shortenText .= '...';

		return $shortenText;
    }

	public function getHtmlItems()
	{
		if (isset($_GET) && !empty($_GET))
		{
			$filter 	= (isset($_GET['filter']) && !empty($_GET['filter'])) ? $_GET['filter'] : null;
			$rooms_number  = (isset($_GET['rooms_number']) && !empty($_GET['rooms_number'])) ? $_GET['rooms_number'] : null;
			$locations  = (isset($_GET['locations']) && !empty($_GET['locations'])) ? explode(',', str_replace('_', ' ', $_GET['locations'])) : null;
			$categories = (isset($_GET['categories']) && !empty($_GET['categories'])) ? explode(',', str_replace('_', ' ', $_GET['categories'])) : null;
			$subcategory = (isset($_GET['subcategory']) && !empty($_GET['subcategory'])) ? $_GET['subcategory'] : null;
			$price 		= (isset($_GET['price']) && !empty($_GET['price'])) ? explode('-', $_GET['price']) : null;
			$type 		= (isset($_GET['type']) && !empty($_GET['type'])) ? $_GET['type'] : null;

			switch ( $type )
			{
				case 'sell':
					$type = [1];
				break;

				case 'rent':
					$type = [2];
				break;

				default:
					$type = [1,2];
				break;
			}

			switch ( $subcategory )
			{
				case 'presale':
					$subcategory = [1];
				break;

				case 'resale':
					$subcategory = [2];
				break;

				case 'lots':
					$subcategory = [3];
				break;

				default:
					$subcategory = [1,2,3];
				break;
			}

			switch ( $filter )
			{
				case 'low_price':
					$filter = 'vkye_properties.price ASC';
				break;

				case 'high_price':
					$filter = 'vkye_properties.price DESC';
				break;

				default:
					$filter = 'vkye_properties.id_property DESC';
				break;
			}

			if ($locations != null)
			{
				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties_locations.title[~]' => $locations
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null,
						'vkye_properties_locations.title[~]' => $locations
					];
				}
			}

			if ($categories != null)
			{
				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties_categories.title[~]' => $categories
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null,
						'vkye_properties_categories.title[~]' => $categories
					];
				}
			}

			if ($price != null)
			{
				if ($price[0] <= 0)
					$price[0] = 1;

				if ($price[1] <= 0)
					$price[1] = 999999999999999999999999999999999999999999999999;

				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null
					];
				}
			}

			if ($locations != null && $categories != null)
			{
				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories
					];
				}
			}

			if ($locations != null && $price != null)
			{
				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null
					];
				}
			}

			if ($categories != null && $price != null)
			{
				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null
					];
				}
			}

			if ($locations != null && $categories != null && $price != null)
			{
				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[>=]' => 1
					];

					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties_locations.title[~]' => $locations,
						'vkye_properties_categories.title[~]' => $categories,
						'vkye_properties.price[<>]' => $price,
						'vkye_properties.popular[=]' => null
					];
				}
			}

			if (!isset($_where1) || empty($_where1))
			{
				if ($rooms_number != null)
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where1 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[>=]' => 1
					];
				}
			}

			if (!isset($_where2) || empty($_where2))
			{
				if ($rooms_number != null)
				{
					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null,
						'vkye_properties.rooms_number_min[<=]' => $rooms_number,
						'vkye_properties.rooms_number_max[>=]' => $rooms_number
					];
				}
				else
				{
					$_where2 = [
						'vkye_properties.id_property_parent' => null,
						'vkye_properties.type' => $type,
						'vkye_properties.subcategory' => $subcategory,
						'vkye_properties.popular[=]' => null
					];
				}
			}

			$response1 = $this->database->select('properties', [
				"[>]vkye_properties_locations" => ['id_location' => 'id_location'],
				"[>]vkye_properties_categories" => ['id_category' => 'id_category']
			], [
				'vkye_properties.id_property',
				'vkye_properties.title(title_property)',
				'vkye_properties.description',
				'vkye_properties.price',
				'vkye_properties.coin',
				'vkye_properties.delivery',
				'vkye_properties.m2',
				'vkye_properties.teaser',
				'vkye_properties.type',
				'vkye_properties.status',
				'vkye_properties.cover',
				'vkye_properties.subcategory',
				'vkye_properties_locations.title(title_location)',
				'vkye_properties_categories.title(title_category)'
			], [
				'AND' => $_where1,
				'ORDER' => $filter,
				'ORDER' => 'vkye_properties.popular ASC',
			]);

			$response2 = $this->database->select('properties', [
				"[>]vkye_properties_locations" => ['id_location' => 'id_location'],
				"[>]vkye_properties_categories" => ['id_category' => 'id_category']
			], [
				'vkye_properties.id_property',
				'vkye_properties.title(title_property)',
				'vkye_properties.description',
				'vkye_properties.price',
				'vkye_properties.coin',
				'vkye_properties.delivery',
				'vkye_properties.m2',
				'vkye_properties.teaser',
				'vkye_properties.type',
				'vkye_properties.status',
				'vkye_properties.cover',
				'vkye_properties.subcategory',
				'vkye_properties_locations.title(title_location)',
				'vkye_properties_categories.title(title_category)'
			], [
				'AND' => $_where2,
				'ORDER' => $filter,
				'ORDER' => 'vkye_properties.id_property DESC',
			]);

			$response = array_merge($response1, $response2);
		}
		else
		{
			$response1 = $this->database->select('properties', [
				"[>]vkye_properties_locations" => ['id_location' => 'id_location'],
				"[>]vkye_properties_categories" => ['id_category' => 'id_category']
			], [
				'vkye_properties.id_property',
				'vkye_properties.title(title_property)',
				'vkye_properties.description',
				'vkye_properties.price',
				'vkye_properties.coin',
				'vkye_properties.delivery',
				'vkye_properties.m2',
				'vkye_properties.teaser',
				'vkye_properties.type',
				'vkye_properties.status',
				'vkye_properties.cover',
				'vkye_properties.subcategory',
				'vkye_properties_locations.title(title_location)',
				'vkye_properties_categories.title(title_category)'
			], [
				'AND' => [
					'vkye_properties.id_property_parent' => null,
					'vkye_properties.popular[>=]' => 1
				],
				'ORDER' => 'vkye_properties.popular ASC'
			]);

			$response2 = $this->database->select('properties', [
				"[>]vkye_properties_locations" => ['id_location' => 'id_location'],
				"[>]vkye_properties_categories" => ['id_category' => 'id_category']
			], [
				'vkye_properties.id_property',
				'vkye_properties.title(title_property)',
				'vkye_properties.description',
				'vkye_properties.price',
				'vkye_properties.coin',
				'vkye_properties.delivery',
				'vkye_properties.m2',
				'vkye_properties.teaser',
				'vkye_properties.type',
				'vkye_properties.status',
				'vkye_properties.cover',
				'vkye_properties.subcategory',
				'vkye_properties_locations.title(title_location)',
				'vkye_properties_categories.title(title_category)'
			], [
				'AND' => [
					'vkye_properties.id_property_parent' => null,
					'vkye_properties.popular[=]' => null
				],
				'ORDER' => 'vkye_properties.id_property DESC'
			]);

			$response = array_merge($response1, $response2);
		}

		$html	= '';
		$clear	= 0;

		foreach ($response as $item)
		{
			$clear = $clear + 1;

			$location = str_replace('_', ' ', $item['title_location']);
			$price = number_format($item['price'], 2);
			$title_link = str_replace(' ', '_', $item['title_property']);

			if ($item['type'] == '1')
			{
				$class = "sell";
				$type = ($this->lang == 'es') ? 'Venta' : 'Sell';
			}

			if ($item['type'] == '2')
			{
				$class = "rent";
				$type = ($this->lang == 'es') ? 'Renta' : 'Rent';
			}

			$category = json_decode($item['title_category']);
			$category = ( !is_null($category) ) ? $category->{$this->lang} : '';
			$category = '';

			$m2 = json_decode($item['m2'], true);
			// $m2 = ( !is_null($m2) ) ? $m2->{$this->lang} : '';
			$m2 = '';

			$html .=
				'<article class="span6" data-order="item">
		            <header>
						<h6>' . $item['title_property'] . '</h6>
					</header>
	                <figure>
	                    <img src="{$path.images}' . $item['cover'] .'" alt="'. $item['title_property'] . '" />
						<a href="/properties/view/'. $item['id_property'] . '/' . strtolower(str_replace(' ', '', $item['title_property'])) . '">{$lang.btn_more_details}</a>
						' . (!empty($item['teaser']) ? '<div class="teaser"><h6>' . json_decode($item['teaser'], true)[$this->lang] . '</h6></div>' : '') . '
						<div class="' . $class . '">' . $type . '</div>
					</figure>
		            <footer>
		                <h6>' . $location . '<span>{$lang.from} <strong>$ ' . number_format($item['price'], 2, '.', ',') . ' ' . $item['coin'] . '</strong></span></h6>
						<h6>
							<label>' . $category . '</label><span><strong>' . json_decode($item['delivery'], true)[$this->lang] . '</strong></span>
						</h6>
						<h6>' . $m2 . '</h6>
		            </footer>
		        </article>' . (($clear == 2) ? '<div class="clear"></div>' : '') . '';

			$clear = ($clear == 2) ? 0 : $clear;
		}

		return $html;
	}

	public function getItem($id)
	{
		$query				= [];
		$charactheristics	= [];
		$amenities			= [];

		$property		= $this->database->select('properties', '*', ['id_property' => $id]);
		$subproperties	= $this->database->select('properties', '*', ['id_property_parent' => $id]);
		$images			= $this->database->select('properties_images', '*', ['id_property' => $id]);
		$location		= $this->database->select('properties_locations', '*', ['id_location' => $property[0]['id_location']]);
		$category		= $this->database->select('properties_categories', '*', ['id_category' => $property[0]['id_category']]);
		$features		= $this->database->select('properties_features_fk', '*', [
			'AND' => [
				'id_property' => $id
			]
		]);

		foreach ($features as $value)
		{
			$data = $this->database->select('properties_features', '*', ['id_feature' => $value['id_feature']]);

			if ($data[0]['type'] == '1')
				array_push($charactheristics, $data[0]);

			if ($data[0]['type'] == '2')
				array_push($amenities, $data[0]);
		}

		$category[0] = !empty($category) ? $category[0] : [];

		array_push($query, $property[0], $subproperties, $images, $location[0], $category[0], $charactheristics, $amenities);

		return $query;
	}

	public function newInterested($name, $lastname, $email, $country, $phone, $observations, $property)
	{
		$today = date('Y-m-d');

		$query = $this->database->insert('properties_interested', [
			'name' => $name,
			'lastname' => $lastname,
			'email' => $email,
			'country' => $country,
			'phone' => $phone,
			'observations' => $observations,
			'date' => $today,
			'id_property' => $property
		]);

		return $query;
	}

	public function getContact()
	{
		$query = $this->database->select('general_configurations', '*');
		return $query[0];
	}

	public function sendEmail($subject, $html, $to, $from)
	{
		$this->component->loadComponent('phpmailer');

		send_email(
			[
				$to[0] => $to[1]
			],
			[
				$from[0],
				$from[1]
			],
			FALSE,
			FALSE,
			FALSE,
			FALSE,
			$subject,
			$html,
			FALSE
		);
	}

	public function getProperty($id)
	{
		$query = $this->database->select('properties', '*', ['id_property' => $id]);
		return $query[0];
	}

	public function getEntryLocation($id)
	{
		$query = $this->database->select('properties_locations', '*', ['id_location' => $id]);
		return $query[0];
	}

	public function getEntryCategory($id)
	{
		$query = $this->database->select('properties_categories', '*', ['id_category' => $id]);
		return $query[0];
	}

	/*
	/* --------------------------------------------------------------------------- */
	public function getLocationsHeader()
	{
		$query = $this->database->select('properties_locations', '*');
		return $query;
	}

	public function getSubpropertyCharacteristics($id)
	{
		$query				= [];
		$charactheristics	= [];

		$features = $this->database->select('properties_features_fk', '*', ['id_property' => $id]);

		foreach ($features as $value)
		{
			$data = $this->database->select('properties_features', '*', ['id_feature' => $value['id_feature']]);

			if ($data[0]['type'] == '1')
				array_push($charactheristics, $data[0]);
		}

		array_push($query, $charactheristics);

		return $query;
	}

	public function getSupropertyImages($id)
	{
		$query = $this->database->select('properties_images', '*', ['id_property' => $id]);
		return $query;
	}

	public function getConfigurations()
    {
      $query = $this->database->select('general_configurations', '*', ['id_configuration' => 1]);
      return $query[0];
    }
}
