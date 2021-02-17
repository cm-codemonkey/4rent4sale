<?php
defined('_EXEC') or die;

class Configurations_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function saveMetadata( $post )
	{
		$this->database->insert('metadata', [
			'description' => $post['description'],
			'keywords' => $post['keywords']
		]);
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

	public function getConfigurations()
    {
      $query = $this->database->select('general_configurations', '*', ['id_configuration' => 1]);
      return $query[0];
    }

	public function getConfiguration($id_configuration)
	{
		$query = $this->database->select('general_configurations', '*', ['id_configuration' => $id_configuration]);
		return $query[0];
	}

	/* about_us
	/* ----------------------------------------------------------------------- */
	public function editAbout($about_us)
	{
		$about_us['es'] = htmlentities($about_us['es'], ENT_QUOTES | ENT_IGNORE, 'UTF-8');
		$about_us['en'] = htmlentities($about_us['en'], ENT_QUOTES | ENT_IGNORE, 'UTF-8');
		$about_us 		= json_encode($about_us);

		$query = $this->database->update('general_configurations', [
			'about_us' => $about_us
		], ['id_configuration' => 1]);

		return $query;
	}

	/* buy_process
	/* ----------------------------------------------------------------------- */
	public function editBuyProcess($buy_process)
	{
		$buy_process['es']  = htmlentities($buy_process['es'], ENT_QUOTES | ENT_IGNORE, 'UTF-8');
		$buy_process['en']  = htmlentities($buy_process['en'], ENT_QUOTES | ENT_IGNORE, 'UTF-8');
		$buy_process 		= json_encode($buy_process);

		$query = $this->database->update('general_configurations', [
			'buy_process' => $buy_process
		], ['id_configuration' => 1]);

		return $query;
	}

	/* contact
	/* ----------------------------------------------------------------------- */
	public function editContact($contact_us)
	{
		$query = $this->database->update('general_configurations', [
			'contact_us' => $contact_us
		], ['id_configuration' => 1]);

		return $query;
	}

	/* cover_home
	/* ----------------------------------------------------------------------- */
	public function editCoverHome($cover_home)
	{
		$query = $this->database->update('general_configurations', [
			'cover_home' => $cover_home
		], ['id_configuration' => 1]);

		return $query;
	}

	/* cover_about
	/* ----------------------------------------------------------------------- */
	public function editCoverAbout($cover_about)
	{
		$query = $this->database->update('general_configurations', [
			'cover_about' => $cover_about
		], ['id_configuration' => 1]);

		return $query;
	}

	/* cover_property
	/* ----------------------------------------------------------------------- */
	public function editCoverProperty($cover_property)
	{
		$query = $this->database->update('general_configurations', [
			'cover_property' => $cover_property
		], ['id_configuration' => 1]);

		return $query;
	}

	/* cover_buy
	/* ----------------------------------------------------------------------- */
	public function editCoverBuy($cover_buy)
	{
		$query = $this->database->update('general_configurations', [
			'cover_buy' => $cover_buy
		], ['id_configuration' => 1]);

		return $query;
	}

	/* cover_blog
	/* ----------------------------------------------------------------------- */
	public function editCoverBlog($cover_blog)
	{
		$query = $this->database->update('general_configurations', [
			'cover_blog' => $cover_blog
		], ['id_configuration' => 1]);

		return $query;
	}

	/* cover_contact
	/* ----------------------------------------------------------------------- */
	public function editCoverContact($cover_contact)
	{
		$query = $this->database->update('general_configurations', [
			'cover_contact' => $cover_contact
		], ['id_configuration' => 1]);

		return $query;
	}

	/*
	/* ----------------------------------------------------------------------- */
	public function uploadBackground($src, $path = PATH_IMAGES)
	{
		list($type, $src) = explode(';', $src);
		list(, $src)      = explode(',', $src);
		$src = base64_decode($src);
		$name = $this->security->randomString(32) . '.png';
		$file = $path . $name;
		$success = file_put_contents($file, $src);

		return $name;
	}

	/* slider-images
	/* ----------------------------------------------------------------------- */
	public function getSliderImages()
    {
        $query = $this->database->select('slider_home', '*');
        return $query;
    }

	public function addSliderImage($title)
    {
		$query = $this->database->insert('slider_home', [
			'title' => $title
		]);

        return $query;
    }

	public function deleteSliderImage($id_image)
    {
		$query = $this->database->delete('slider_home', [
			'id_image' => $id_image
		]);

        return $query;
    }

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
