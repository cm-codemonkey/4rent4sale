<?php defined('_EXEC') or die;

class Blog_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEntries($pop)
	{
		if ($pop == 'blog')
		{
			$query1 = $this->database->select('blog_entries', '*', [
				'popular_blog[>=]' => 1,
				'ORDER' => 'popular_blog ASC'
			]);

			$query2 = $this->database->select('blog_entries', '*', [
				'popular_blog[=]' => null,
				'ORDER' => 'id_entry ASC'
			]);

			$query = array_merge($query1, $query2);
		}
		else if ($pop == 'home')
		{
			$query = $this->database->select('blog_entries', '*', [
				'popular_home[>=]' => 1,
				'ORDER' => 'popular_home ASC'
			]);
		}

		return $query;
	}

	public function getEntry($id_entry)
	{
		$query = $this->database->select('blog_entries', '*', ['id_entry' => $id_entry]);
		return $query[0];
	}

	public function getEntryAuthor($id_user)
	{
		$query = $this->database->select('website_users', '*', ['id_website_user' => $id_user]);
		return $query[0];
	}

	public function getLocations()
    {
        $query = $this->database->select('properties_locations', '*');
        return $query;
    }

	public function getEntryLocation($id_entry)
	{
		$query = $this->database->select('properties_locations', '*', ['id_location' => $id_entry]);
		return $query[0];
	}

	public function editPopular($id_entry, $popular_blog, $popular_home)
	{
		$a = $this->database->select('blog_entries', '*', ['id_entry' => $id_entry]);

		if (!empty($a[0]['popular_blog']) AND $a[0]['popular_blog'] < $popular_blog)
		{
			$b = $this->database->select('blog_entries', '*', [
				'AND' => [
					'popular_blog[>]' => $a[0]['popular_blog'],
					'popular_blog[<=]' => $popular_blog,
				],
				'ORDER' => 'popular_blog ASC',
			]);

			if (!empty($b))
			{
				foreach ($b as $v)
				{
					$this->database->update('blog_entries', [
						'popular_blog' => ($v['popular_blog'] - 1)
					], [
						'id_entry' => $v['id_entry']
					]);
				}
			}
		}
		else
		{
			$b = $this->database->select('blog_entries', '*', [
				'AND' => [
					'id_entry[!]' => $a[0]['id_entry'],
					'popular_blog[>=]' => $popular_blog,
				],
				'ORDER' => 'popular_blog ASC',
			]);

			if (!empty($b))
			{
				foreach ($b as $v)
				{
					$this->database->update('blog_entries', [
						'popular_blog' => ($v['popular_blog'] + 1)
					], [
						'id_entry' => $v['id_entry']
					]);
				}
			}
		}

		$this->database->update('blog_entries', [
			'popular_blog' => $popular_blog
		], [
			'id_entry' => $a[0]['id_entry']
		]);

		$b = $this->database->select('blog_entries', '*', [
			'popular_blog[>=]' => 1,
			'ORDER' => 'popular_blog ASC',
		]);

		if (!empty($b))
		{
			$i = 1;

			foreach ($b as $v)
			{
				$this->database->update('blog_entries', [
					'popular_blog' => $i
				], [
					'id_entry' => $v['id_entry']
				]);

				$i = $i + 1;
			}
		}

		if (!empty($a[0]['popular_home']) AND $a[0]['popular_home'] < $popular_home)
		{
			$b = $this->database->select('blog_entries', '*', [
				'AND' => [
					'popular_home[>]' => $a[0]['popular_home'],
					'popular_home[<=]' => $popular_home,
				],
				'ORDER' => 'popular_home ASC',
			]);

			if (!empty($b))
			{
				foreach ($b as $v)
				{
					$this->database->update('blog_entries', [
						'popular_home' => ($v['popular_home'] - 1)
					], [
						'id_entry' => $v['id_entry']
					]);
				}
			}
		}
		else
		{
			$b = $this->database->select('blog_entries', '*', [
				'AND' => [
					'id_entry[!]' => $a[0]['id_entry'],
					'popular_home[>=]' => $popular_home,
				],
				'ORDER' => 'popular_home ASC',
			]);

			if (!empty($b))
			{
				foreach ($b as $v)
				{
					$this->database->update('blog_entries', [
						'popular_home' => ($v['popular_home'] + 1)
					], [
						'id_entry' => $v['id_entry']
					]);
				}
			}
		}

		$this->database->update('blog_entries', [
			'popular_home' => $popular_home
		], [
			'id_entry' => $a[0]['id_entry']
		]);

		$b = $this->database->select('blog_entries', '*', [
			'popular_home[>=]' => 1,
			'ORDER' => 'popular_home ASC',
		]);

		if (!empty($b))
		{
			$i = 1;

			foreach ($b as $v)
			{
				$this->database->update('blog_entries', [
					'popular_home' => $i
				], [
					'id_entry' => $v['id_entry']
				]);

				$i = $i + 1;
			}
		}

		return true;
	}

	public function newEntry($seo_keywords, $seo_description, $title, $description, $cover, $popular_blog, $popular_home, $location)
	{
		$permitted = false;

		if (isset($popular_blog) AND !empty($popular_blog))
		{
			$a = $this->database->select('blog_entries', '*', [
				'popular_blog[>=]' => $popular_blog,
				'ORDER' => 'popular_blog ASC',
			]);

			if (!empty($a))
			{
				foreach ($a as $v)
				{
					$this->database->update('blog_entries', [
						'popular_blog' => ($v['popular_blog'] + 1)
					], [
						'id_entry' => $v['id_entry']
					]);
				}
			}

			$permitted = true;
		}

		if (isset($popular_home) AND !empty($popular_home))
		{
			$a = $this->database->select('blog_entries', '*', [
				'popular_home[>=]' => $popular_home,
				'ORDER' => 'popular_home ASC',
			]);

			if (!empty($a))
			{
				foreach ($a as $v)
				{
					$this->database->update('blog_entries', [
						'popular_home' => ($v['popular_home'] + 1)
					], [
						'id_entry' => $v['id_entry']
					]);
				}
			}

			$permitted = true;
		}

		if ($permitted == true)
		{
			$title 				= json_encode($title);
			$description['es'] 	= htmlentities($description['es'], ENT_QUOTES | ENT_IGNORE, 'UTF-8');
			$description['en'] 	= htmlentities($description['en'], ENT_QUOTES | ENT_IGNORE, 'UTF-8');
			$description 		= json_encode($description);

			$query = $this->database->insert('blog_entries', [
				'title' => $title,
				'date' => Format::getDateHour(),
				'description' => $description,
				'cover' => $cover,
				'id_website_user' => Session::getValue("id_user"),
				'popular_blog' => $popular_blog,
				'popular_home' => $popular_home,
				'id_location' => $location,
				'seo_keywords' => $seo_keywords,
				'seo_description' => $seo_description
			]);

			return $query;
		}
	}

	public function editEntry($seo_keywords, $seo_description, $id_entry, $title, $description, $cover, $popular_blog, $location)
	{
		// $permitted = false;
		$permitted = true;

		// if (isset($popular_blog) AND !empty($popular_blog))
		// {
		// 	$entries = $this->database->select('blog_entries', '*', ['popular_blog[>=]' => $popular_blog]);
		//
		// 	if (!empty($entries))
		// 	{
		// 		foreach ($entries as $value)
		// 		{
		// 			$this->database->update('blog_entries', [
		// 				'popular_blog' => ($value['popular_blog'] + 1)
		// 			], [
		// 				'id_entry' => $value['id_entry']
		// 			]);
		// 		}
		// 	}
		//
		// 	$permitted = true;
		// }

		if ($permitted == true)
		{
			$query = $this->database->update('blog_entries', [
				'title' => $title,
				'description' => $description,
				'cover' => $cover,
				// 'popular_blog' => $popular_blog,
				'id_location' => $location,
				'seo_keywords' => $seo_keywords,
				'seo_description' => $seo_description
			], ['id_entry' => $id_entry]);

			return $query;
		}
	}

	public function deleteEntries($data)
	{
		$query = $this->database->delete('blog_entries', [
			'id_entry' => $data
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
}
