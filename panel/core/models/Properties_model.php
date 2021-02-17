<?php defined('_EXEC') or die;

class Properties_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* properties
	/* ----------------------------------------------------------------------- */
	public function getProperties()
	{
		$query = $this->database->select('properties', '*', ['id_property_parent' => null, 'ORDER' => 'id_property DESC']);
		return $query;
	}

	public function getEntries($sub = null)
	{
		$query1 = $this->database->select('properties', '*', [
			'AND' => [
				'popular[>=]' => 1,
				'id_property_parent' => null,
				'subcategory' => $sub,
			],
			'ORDER' => 'popular ASC'
		]);

		$query2 = $this->database->select('properties', '*', [
			'AND' => [
				'popular[=]' => null,
				'id_property_parent' => null,
				'subcategory' => $sub,
			],
			'ORDER' => 'id_property DESC'
		]);

		$query = array_merge($query1, $query2);

		return $query;
	}

	public function getProperty($id_property)
	{
		$query = $this->database->select('properties', '*', ['id_property' => $id_property]);
		return $query[0];
	}

	public function getPropertyLocation($id_property)
	{
		$query = $this->database->select('properties_locations', '*', ['id_location' => $id_property]);
		return $query[0];
	}

	public function getPropertyCategory($id_property)
	{
		$query = $this->database->select('properties_categories', '*', ['id_category' => $id_property]);
		return $query[0];
	}

	public function getPropertyFeatures($id_property, $type)
	{
		if(isset($type))
		{
			$query = $this->database->select('properties_features_fk', '*', [
				'AND' => [
					'id_property' => $id_property,
					'type' => $type
				]
			]);
		}
		else
		{
			$query = $this->database->select('properties_features_fk', '*', ['id_property' => $id_property]);
		}

		return $query;
	}

	public function editPopular($id_property, $popular)
	{
		$a = $this->database->select('properties', '*', ['id_property' => $id_property]);

		if (!empty($a[0]['popular']) AND $a[0]['popular'] < $popular)
		{
			$b = $this->database->select('properties', '*', [
				'AND' => [
					'subcategory' => $a[0]['subcategory'],
					'popular[>]' => $a[0]['popular'],
					'popular[<=]' => $popular,
				],
				'ORDER' => 'popular ASC',
			]);

			if (!empty($b))
			{
				foreach ($b as $v)
				{
					$this->database->update('properties', [
						'popular' => ($v['popular'] - 1)
					], [
						'id_property' => $v['id_property']
					]);
				}
			}
		}
		else
		{
			$b = $this->database->select('properties', '*', [
				'AND' => [
					'id_property[!]' => $a[0]['id_property'],
					'subcategory' => $a[0]['subcategory'],
					'popular[>=]' => $popular,
				],
				'ORDER' => 'popular ASC',
			]);

			if (!empty($b))
			{
				foreach ($b as $v)
				{
					$this->database->update('properties', [
						'popular' => ($v['popular'] + 1)
					], [
						'id_property' => $v['id_property']
					]);
				}
			}
		}

		$this->database->update('properties', [
			'popular' => $popular
		], [
			'id_property' => $a[0]['id_property']
		]);

		$b = $this->database->select('properties', '*', [
			'AND' => [
				'subcategory' => $a[0]['subcategory'],
				'popular[>=]' => 1,
			],
			'ORDER' => 'popular ASC',
		]);

		if (!empty($b))
		{
			$i = 1;

			foreach ($b as $v)
			{
				$this->database->update('properties', [
					'popular' => $i
				], [
					'id_property' => $v['id_property']
				]);

				$i = $i + 1;
			}
		}

		return true;
	}

    public function newProperty($seo_keywords, $seo_description, $title, $description, $price, $coin, $delivery, $rooms, $rooms_number_min, $rooms_number_max, $m2, $teaser, $type, $pdf, $cover, $multiple, $location, $category, $subcategory, $characteristics, $amenities, $popular)
    {
		$permitted = false;

		if (isset($popular) AND !empty($popular))
		{
			$a = $this->database->select('properties', '*', [
				'AND' => [
					'subcategory' => $subcategory,
					'popular[>=]' => $popular,
				],
				'ORDER' => 'popular ASC',
			]);

			if (!empty($a))
			{
				foreach ($a as $v)
				{
					$this->database->update('properties', [
						'popular' => ($v['popular'] + 1)
					], [
						'id_property' => $v['id_property']
					]);
				}
			}

			$permitted = true;
		}
		else
			$permitted = true;

		if ($permitted == true)
		{
			$today	= date('Y-m-d');
			$status	= empty($multiple) ? '1' : null;

	    	$query = $this->database->insert('properties', [
	    		'title' => $title,
	    		'description' => $description,
				'date' => $today,
	    		'price' => $price,
				'coin' => $coin,
				'delivery' => $delivery,
				'rooms' => $rooms,
				'rooms_number_min' => $rooms_number_min,
				'rooms_number_max' => $rooms_number_max,
				'm2' => $m2,
				'teaser' => $teaser,
				'type' => $type,
				'status' => $status,
				'pdf' => $pdf,
				'cover' => $cover,
				'multiple' => $multiple,
				'id_location' => $location,
	    		'id_category' => null,
	    		'subcategory' => $subcategory,
	    		'popular' => $popular,
				'seo_keywords' => $seo_keywords,
				'seo_description' => $seo_description
    		]);

			if(isset($query) AND !empty($query))
			{
				if(isset($characteristics) AND !empty($characteristics))
				{
					foreach ($characteristics as $characteristic) {
						$insert = $this->database->insert('properties_features_fk', [
							'id_property' => $query,
							'id_feature' => $characteristic,
							'type' => '1'
						]);
					}
				}

				if(isset($amenities) AND !empty($amenities))
				{
					foreach ($amenities as $amenity) {
						$insert = $this->database->insert('properties_features_fk', [
							'id_property' => $query,
							'id_feature' => $amenity,
							'type' => '2'
						]);
					}
				}
			}

        	return $query;
		}
    }

	public function editProperty($seo_keywords, $seo_description, $id_property, $title, $description, $price, $coin, $delivery, $rooms, $rooms_number_min, $rooms_number_max, $m2, $teaser, $type, $status, $pdf, $cover, $multiple, $location, $category, $subcategory, $characteristics, $amenities, $popular)
    {
		// $permitted = false;
		$permitted = true;

		// if (isset($popular) AND !empty($popular))
		// {
		// 	$properties = $this->database->select('properties', '*', ['popular[>=]' => $popular]);
		//
		// 	if (!empty($properties))
		// 	{
		// 		foreach ($properties as $value)
		// 		{
		// 			$this->database->update('properties', [
		// 				'popular' => ($value['popular'] + 1)
		// 			], [
		// 				'id_property' => $value['id_property']
		// 			]);
		// 		}
		// 	}
		//
		// 	$permitted = true;
		// }
		// else
		// 	$permitted = true;

		if ($permitted == true)
		{
			if(empty($multiple))
				$status = $status;
			else
				$status = null;

	    	$query = $this->database->update('properties', [
	    		'title' => $title,
	    		'description' => $description,
	    		'price' => $price,
				'coin' => $coin,
				'delivery' => $delivery,
				'rooms' => $rooms,
				'rooms_number_min' => $rooms_number_min,
				'rooms_number_max' => $rooms_number_max,
				'm2' => $m2,
				'teaser' => $teaser,
				'type' => $type,
				'status' => $status,
				'pdf' => $pdf,
				'cover' => $cover,
				'multiple' => $multiple,
				'id_location' => $location,
	    		'id_category' => null,
	    		'subcategory' => $subcategory,
				// 'popular' => $popular,
				'seo_keywords' => $seo_keywords,
				'seo_description' => $seo_description
	    	], ['id_property' => $id_property]);

			$delete = $this->database->delete("properties_features_fk", [
				'id_property' => $id_property
			]);

			if(isset($characteristics) AND !empty($characteristics))
			{
				foreach ($characteristics as $characteristic) {
					$insert = $this->database->insert('properties_features_fk', [
						'id_property' => $id_property,
						'id_feature' => $characteristic,
						'type' => '1'
					]);
				}
			}

			if(isset($amenities) AND !empty($amenities))
			{
				foreach ($amenities as $amenity) {
					$insert = $this->database->insert('properties_features_fk', [
						'id_property' => $id_property,
						'id_feature' => $amenity,
						'type' => '2'
					]);
				}
			}

	        return (isset($query) AND !empty($query)) ? $query : $insert;
		}
    }

	public function deleteProperties($data)
	{
		$delete = $this->database->delete('properties_features_fk', [
			'id_property' => $data
		]);

		$delete = $this->database->delete('properties_images', [
			'id_property' => $data
		]);

		$delete = $this->database->delete('properties_interested', [
			'id_property' => $data
		]);

		$query = $this->database->delete('properties', [
			'id_property' => $data
		]);

		return $query;
	}

	/* subproperties
	/* ----------------------------------------------------------------------- */
	public function getSubproperties($id_property)
    {
        $query = $this->database->select('properties', '*', ['$id_property_parent' => $id_property]);
        return $query;
    }

	public function newSubproperty($title, $rooms, $m2, $cover, $characteristics, $id_property)
    {
		$today	= date('Y-m-d');

    	$query = $this->database->insert('properties', [
    		'title' => $title,
			'date' => $today,
			'rooms' => $rooms,
			'm2' => $m2,
			'status' => '1',
			'cover' => $cover,
    		'id_property_parent' => $id_property
    	]);

		if(isset($query) AND !empty($query))
		{
			if(isset($characteristics) AND !empty($characteristics))
			{
				foreach ($characteristics as $characteristic) {
					$insert = $this->database->insert('properties_features_fk', [
						'id_property' => $query,
						'id_feature' => $characteristic,
						'type' => '1'
					]);
				}
			}
		}

        return $query;
    }

	public function editSubproperty($id_property, $title, $rooms, $m2, $status, $cover, $characteristics)
    {
    	$query = $this->database->update('properties', [
    		'title' => $title,
			'rooms' => $rooms,
			'm2' => $m2,
			'status' => $status,
			'cover' => $cover
    	], ['id_property' => $id_property]);

		$delete = $this->database->delete("properties_features_fk", [
			'id_property' => $id_property
		]);

		if(isset($characteristics) AND !empty($characteristics))
		{
			foreach ($characteristics as $characteristic) {
				$insert = $this->database->insert('properties_features_fk', [
					'id_property' => $id_property,
					'id_feature' => $characteristic,
					'type' => '1'
				]);
			}
		}

        return (isset($query) AND !empty($query)) ? $query : $insert;
    }

	/* property-images
	/* ----------------------------------------------------------------------- */
	public function getPropertyImages($id_property)
    {
        $query = $this->database->select('properties_images', '*', ['id_property' => $id_property]);
        return $query;
    }

	public function addPropertyImage($title, $property)
    {
		$query = $this->database->insert('properties_images', [
			'title' => $title,
			'id_property' => $property
		]);

        return $query;
    }

	public function deletePropertyImage($id_image)
    {
		$query = $this->database->delete('properties_images', [
			'id_image' => $id_image
		]);

        return $query;
    }

	/* properties-interested
	/* ----------------------------------------------------------------------- */
	public function getPropertiesInterested()
	{
		$query = $this->database->select('properties_interested', '*');
		return $query;
	}

	/* locations
	/* ----------------------------------------------------------------------- */
	public function getLocations()
    {
        $query = $this->database->select('properties_locations', '*');
        return $query;
    }

    public function getLocation($id_location)
    {
        $query = $this->database->select('properties_locations', '*', ['id_location' => $id_location]);
        return $query[0];
    }

    public function newLocation($title, $properties, $blog)
    {
        $query = $this->database->insert('properties_locations', [
            'title' => $title,
            'properties' => $properties,
            'blog' => $blog
        ]);

        return $query;
    }

    public function editLocation($id_location, $title, $properties, $blog)
    {
        $query = $this->database->update('properties_locations', [
            'title' => $title,
			'properties' => $properties,
            'blog' => $blog
        ], ['id_location' => $id_location]);

        return $query;
    }

	public function deleteLocations($data)
	{
		$query = $this->database->delete("properties_locations", [
			'id_location' => $data
		]);

		return $query;
	}

	/* categories
	/* ----------------------------------------------------------------------- */
    public function getCategories()
    {
        $query = $this->database->select('properties_categories', '*');
        return $query;
    }

    public function getCategory($id_category)
    {
        $query = $this->database->select('properties_categories', '*', ['id_category' => $id_category]);
        return $query[0];
    }

    public function newCategory($title, $cover)
    {
        $query = $this->database->insert('properties_categories', [
            'title' => $title,
			'cover' => $cover
        ]);

        return $query;
    }

	public function editCategory($id_category, $title, $cover)
    {
        $query = $this->database->update('properties_categories', [
            'title' => $title,
			'cover' => $cover
        ], ['id_category' => $id_category]);

        return $query;
    }

	public function deleteCategories($data)
	{
		$query = $this->database->delete("properties_categories", [
			'id_category' => $data
		]);

		return $query;
	}

	/* features
	/* ----------------------------------------------------------------------- */
	public function getFeatures($type)
    {
		if(isset($type))
		{
			$query = $this->database->select('properties_features', '*', [
				'AND' => [
					'type' => $type
				]
			]);
		}
		else
		{
			$query = $this->database->select('properties_features', '*', ['ORDER' => 'type ASC']);
		}

        return $query;
    }

    public function getFeature($id_feature)
    {
        $query = $this->database->select('properties_features', '*', ['id_feature' => $id_feature]);
        return $query[0];
    }

    public function newFeature($title, $type, $icon)
    {
        $query = $this->database->insert('properties_features', [
            'title' => $title,
			'type' => $type,
			'icon' => $icon
        ]);

        return $query;
    }

    public function editFeature($id_feature, $title, $type, $icon)
    {
        $query = $this->database->update('properties_features', [
            'title' => $title,
			'type' => $type,
			'icon' => $icon
        ], ['id_feature' => $id_feature]);

        return $query;
    }

	public function deleteFeatures($data)
	{
		$query = $this->database->delete("properties_features", [
			'id_feature' => $data
		]);

		return $query;
	}

	/*
	/* ----------------------------------------------------------------------- */
	public function createImage($src, $path = PATH_IMAGES)
	{
		list($type, $src) = explode(';', $src);
		list(, $src)      = explode(',', $src);
		$src = base64_decode($src);
		$name = $this->security->randomString(32) . '.png';
		$file = $path . $name;
		$success = file_put_contents($file, $src);

		return $name;
	}

	public function createPdf($src, $path = PATH_IMAGES)
	{
		list($type, $src) = explode(';', $src);
		list(, $src)      = explode(',', $src);
		$src = base64_decode($src);
		$name = $this->security->randomString(32) . '.pdf';
		$file = $path . $name;
		$success = file_put_contents($file, $src);

		return $name;
	}
}
