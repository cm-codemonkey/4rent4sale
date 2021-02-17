<?php
defined('_EXEC') or die;

class Properties_controller extends Controller
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

			$properties1 = $this->model->getEntries('1');
			$properties2 = $this->model->getEntries('2');
			$properties3 = $this->model->getEntries('3');

			$list1 = '';
			$list2 = '';
			$list3 = '';

			foreach ($properties1 as $property)
			{
				if($property['type'] == '1')
					$type = 'Venta';

				if($property['type'] == '2')
					$type = 'Renta';

				$location = $this->model->getPropertyLocation($property['id_location']);
				// $category = $this->model->getPropertyCategory($property['id_category']);
				// $subproperties = $this->model->getSubproperties($property['id_property']);

				// if ($property['subcategory'] == '1')
				// 	$subcategory = 'Pre-venta';
				// else if ($property['subcategory'] == '2')
				// 	$subcategory = 'Re-venta';

				$list1 .=
				'<tr>
					<td>' . (empty($subproperties) ? '<input type="checkbox" data-check value="' . $property['id_property'] . '" />' : '') . '</td>
					<td data-title="title">' . $property['title'] . '</td>
					<td data-title="type">' . $type . '</td>
					<td data-title="location">' . $location['title'] . '</td>
					<td data-title="popular">' . (empty($property['popular']) ? '<span>No destacado</span>' : $property['popular']) . '</td>
					<td class="text-right">
						' . (($property['multiple'] == true) ? '<a href="index.php?c=properties&m=subproperties&p=' . $property['id_property'] . '"><i class="material-icons">home</i></a>' : '') . '
						<a href="" data-action="getPopularToEdit" data-id="' . $property['id_property'] . '"><i class="material-icons">flag</i></a>
						<a href="index.php?c=properties&m=addImages&p=' . $property['id_property'] . '"><i class="material-icons">photo</i></a>
						<a href="index.php?c=properties&m=editProperty&p=' . $property['id_property'] . '"><i class="material-icons">edit</i></a>
					</td>
				</tr>';
			}

			foreach ($properties2 as $property)
			{
				if($property['type'] == '1')
					$type = 'Venta';

				if($property['type'] == '2')
					$type = 'Renta';

				$location = $this->model->getPropertyLocation($property['id_location']);
				// $category = $this->model->getPropertyCategory($property['id_category']);
				// $subproperties = $this->model->getSubproperties($property['id_property']);

				// if ($property['subcategory'] == '1')
				// 	$subcategory = 'Pre-venta';
				// else if ($property['subcategory'] == '2')
				// 	$subcategory = 'Re-venta';

				$list2 .=
				'<tr>
					<td>' . (empty($subproperties) ? '<input type="checkbox" data-check value="' . $property['id_property'] . '" />' : '') . '</td>
					<td data-title="title">' . $property['title'] . '</td>
					<td data-title="type">' . $type . '</td>
					<td data-title="location">' . $location['title'] . '</td>
					<td data-title="popular">' . (empty($property['popular']) ? '<span>No destacado</span>' : $property['popular']) . '</td>
					<td class="text-right">
						' . (($property['multiple'] == true) ? '<a href="index.php?c=properties&m=subproperties&p=' . $property['id_property'] . '"><i class="material-icons">home</i></a>' : '') . '
						<a href="" data-action="getPopularToEdit" data-id="' . $property['id_property'] . '"><i class="material-icons">flag</i></a>
						<a href="index.php?c=properties&m=addImages&p=' . $property['id_property'] . '"><i class="material-icons">photo</i></a>
						<a href="index.php?c=properties&m=editProperty&p=' . $property['id_property'] . '"><i class="material-icons">edit</i></a>
					</td>
				</tr>';
			}

			foreach ($properties3 as $property)
			{
				if($property['type'] == '1')
					$type = 'Venta';

				if($property['type'] == '2')
					$type = 'Renta';

				$location = $this->model->getPropertyLocation($property['id_location']);
				// $category = $this->model->getPropertyCategory($property['id_category']);
				// $subproperties = $this->model->getSubproperties($property['id_property']);

				// if ($property['subcategory'] == '1')
				// 	$subcategory = 'Pre-venta';
				// else if ($property['subcategory'] == '2')
				// 	$subcategory = 'Re-venta';

				$list3 .=
				'<tr>
					<td>' . (empty($subproperties) ? '<input type="checkbox" data-check value="' . $property['id_property'] . '" />' : '') . '</td>
					<td data-title="title">' . $property['title'] . '</td>
					<td data-title="type">' . $type . '</td>
					<td data-title="location">' . $location['title'] . '</td>
					<td data-title="popular">' . (empty($property['popular']) ? '<span>No destacado</span>' : $property['popular']) . '</td>
					<td class="text-right">
						' . (($property['multiple'] == true) ? '<a href="index.php?c=properties&m=subproperties&p=' . $property['id_property'] . '"><i class="material-icons">home</i></a>' : '') . '
						<a href="" data-action="getPopularToEdit" data-id="' . $property['id_property'] . '"><i class="material-icons">flag</i></a>
						<a href="index.php?c=properties&m=addImages&p=' . $property['id_property'] . '"><i class="material-icons">photo</i></a>
						<a href="index.php?c=properties&m=editProperty&p=' . $property['id_property'] . '"><i class="material-icons">edit</i></a>
					</td>
				</tr>';
			}

			$replace = [
				'{$list1}' => $list1,
				'{$list2}' => $list2,
				'{$list3}' => $list3,
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	/* Obtener destacados de cada propiedad para editar
	--------------------------------------------------------------------------- */
	public function getPopularToEdit($id_property)
	{
		if (Session::getValue('level') > 8)
		{
			if (Format::existAjaxRequest() == true)
			{
				$property = $this->model->getProperty($id_property);

				if (!empty($property))
	            {
	                echo json_encode([
						'status' => 'success',
						'data' => $property
					]);
	            }
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'Propiedad no encontrada'
					]);
				}
			}
			else
				Errors::http('404');
		}
		else
			header('Location: /');
	}

	public function addProperty()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$seo_keywords		= $_POST['seo-keywords'];
				$seo_description	= $_POST['seo-description'];
				$link				= isset($_POST['link']) ? $_POST['link'] : '';
				$title			 	= isset($_POST['title']) ? $_POST['title'] : '';
				$description		= isset($_POST['description']) ? $_POST['description'] : '';
				$description_en		= isset($_POST['description_en']) ? $_POST['description_en'] : '';
				$location			= isset($_POST['location']) ? $_POST['location'] : '';
				// $category			= isset($_POST['category']) ? $_POST['category'] : '';
				$subcategory		= isset($_POST['subcategory']) ? $_POST['subcategory'] : '';
				$price 				= isset($_POST['price']) ? $_POST['price'] : '';
				$coin 				= isset($_POST['coin']) ? $_POST['coin'] : '';
				$delivery 			= isset($_POST['delivery']) ? $_POST['delivery'] : '';
				$delivery_en 		= isset($_POST['delivery_en']) ? $_POST['delivery_en'] : '';
				$rooms 				= isset($_POST['rooms']) ? $_POST['rooms'] : '';
				$rooms_number_min 		= isset($_POST['rooms_number_min']) ? $_POST['rooms_number_min'] : '';
				$rooms_number_max 		= isset($_POST['rooms_number_max']) ? $_POST['rooms_number_max'] : '';
				$rooms_en 			= isset($_POST['rooms_en']) ? $_POST['rooms_en'] : '';
				$m2 				= isset($_POST['m2']) ? $_POST['m2'] : '';
				$m2_en 				= isset($_POST['m2_en']) ? $_POST['m2_en'] : '';
				$teaser 			= (isset($_POST['teaser']) AND !empty($_POST['teaser'])) ? $_POST['teaser'] : '';
				$teaser_en 			= (isset($_POST['teaser_en']) AND !empty($_POST['teaser_en'])) ? $_POST['teaser_en'] : '';
				$type 				= (isset($_POST['sell']) AND !empty($_POST['sell'])) ? '1' : '';
				$type 				= (isset($_POST['rent']) AND !empty($_POST['rent'])) ? '2' : $type;
				$multiple			= (isset($_POST['multiple']) AND !empty($_POST['multiple'])) ? true : false;
				$characteristics	= (isset($_POST['chtc']) AND !empty($_POST['chtc'])) ? explode(',', $_POST['chtc']) : '';
				$amenities			= (isset($_POST['amtg']) AND !empty($_POST['amtg'])) ? explode(',', $_POST['amtg']) : '';
				$pdf				= (isset($_POST['pdf']) AND !empty($_POST['pdf'])) ? $_POST['pdf'] : null;
				$popular			= (isset($_POST['popular']) AND !empty($_POST['popular'])) ? $_POST['popular'] : null;

				if (isset($popular) AND !is_numeric($popular))
					$message = 'Dato incorrecto 1';
				else if (isset($popular) AND $popular < 1 OR isset($popular) AND $popular > 100)
					$message = 'Dato incorrecto 2';

				if(!empty($_POST['sell']) AND !empty($_POST['rent']))
					$message = 'Seleccione venta o renta';

				if(empty($delivery))
					$message = 'Ingrese la entrega de la propiedad';

				if(empty($coin))
					$message = 'Seleccione un tipo de moneda';

				if(!is_numeric($price))
					$message = 'Solo ingrese números como precio de la propiedad';

				if(empty($price))
					$message = 'Ingrese el precio de la propiedad';

				if(empty($subcategory))
					$message = 'Seleccione una subcategoria';

				// if(empty($category))
				// 	$message = 'Seleccione una categoria';

				if(empty($location))
					$message = 'Seleccione una ubicación';

				if(empty($description))
					$message = 'Ingrese una descripción';

				if(empty($title))
					$message = 'Ingrese el titulo';

				if(empty($link))
					$message = 'Seleccione la imagen';

				if(!isset($message))
				{
					$description = json_encode([
						'es' => htmlentities($description, ENT_QUOTES | ENT_IGNORE, 'UTF-8'),
						'en' => htmlentities($description_en, ENT_QUOTES | ENT_IGNORE, 'UTF-8')
					]);

					$delivery = json_encode([
						'es' => $delivery,
						'en' => $delivery_en
					]);

					if (!empty($rooms))
					{
						$rooms = json_encode([
							'es' => $rooms,
							'en' => $rooms_en
						]);
					}

					if (!empty($m2))
					{
						$m2 = json_encode([
							'es' => $m2,
							'en' => $m2_en
						]);
					}

					if (!empty($teaser))
					{
						$teaser = json_encode([
							'es' => $teaser,
							'en' => $teaser_en
						]);
					}

					$link = $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);

					if (!empty($pdf))
					{
						$pdf = $this->model->createPdf(str_replace(' ', '+', $pdf), PATH_IMAGES);
					}

					$newProperty = $this->model->newProperty($seo_keywords, $seo_description, $title, $description, $price, $coin, $delivery, $rooms, $rooms_number_min, $rooms_number_max, $m2, $teaser, $type, $pdf, $link, $multiple, $location, null, $subcategory, $characteristics, $amenities, $popular);

					if(!empty($newProperty))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'index.php?c=properties'
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

				$template = $this->view->render($this, 'addProperty');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$locations			= $this->model->getLocations();
				$categories			= $this->model->getCategories();
				$characteristics	= $this->model->getFeatures('1');
				$amenities			= $this->model->getFeatures('2');

				$locationsList			= '';
				$categoriesList			= '';
				$characteristicsList	= '';
				$amenitiesList			= '';

				foreach ($locations as $location)
				{
					$locationsList .=
					'<option value="' . $location['id_location'] . '" />' . $location['title'] . '</option>';
				}

				foreach ($categories as $category)
				{
					$categoriesList .=
					'<option value="' . $category['id_category'] . '" />' . json_decode($category['title'], true)['es'] . '</option>';
				}

				foreach ($characteristics as $characteristic)
				{
					$characteristicsList .=
					'<div class="feature">
	                    <input type="checkbox" data-action="sendChtc" data-id="' . $characteristic['id_feature'] . '">
	                    <h6>' . json_decode($characteristic['title'], true)['es'] . '</h6>
	                    <div class="clear"></div>
	                </div>';
				}

				foreach ($amenities as $amenity)
				{
					$amenitiesList .=
					'<div class="feature">
	                    <input type="checkbox" data-action="sendAmtg" data-id="' . $amenity['id_feature'] . '">
	                    <h6>' . json_decode($amenity['title'], true)['es'] . '</h6>
	                    <div class="clear"></div>
	                </div>';
				}

				$replace = [
					'{$locationsList}' => $locationsList,
					'{$categoriesList}' => $categoriesList,
					'{$characteristicsList}' => $characteristicsList,
					'{$amenitiesList}' => $amenitiesList
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function editProperty($id_property)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$seo_keywords		= $_POST['seo-keywords'];
				$seo_description	= $_POST['seo-description'];
				$link				= isset($_POST['link']) ? $_POST['link'] : '';
				$title			 	= isset($_POST['title']) ? $_POST['title'] : '';
				$description		= isset($_POST['description']) ? $_POST['description'] : '';
				$description_en		= isset($_POST['description_en']) ? $_POST['description_en'] : '';
				$location			= isset($_POST['location']) ? $_POST['location'] : '';
				// $category			= isset($_POST['category']) ? $_POST['category'] : '';
				$subcategory		= isset($_POST['subcategory']) ? $_POST['subcategory'] : '';
				$price 				= isset($_POST['price']) ? $_POST['price'] : '';
				$coin 				= isset($_POST['coin']) ? $_POST['coin'] : '';
				$delivery 			= isset($_POST['delivery']) ? $_POST['delivery'] : '';
				$delivery_en 		= isset($_POST['delivery_en']) ? $_POST['delivery_en'] : '';
				$rooms 				= (isset($_POST['rooms']) AND !empty($_POST['rooms'])) ? $_POST['rooms'] : '';
				$rooms_number_min 		= (isset($_POST['rooms_number_min']) AND !empty($_POST['rooms_number_min'])) ? $_POST['rooms_number_min'] : '';
				$rooms_number_max 		= (isset($_POST['rooms_number_max']) AND !empty($_POST['rooms_number_max'])) ? $_POST['rooms_number_max'] : '';
				$rooms_en 			= isset($_POST['rooms_en']) ? $_POST['rooms_en'] : '';
				$m2 				= (isset($_POST['m2']) AND !empty($_POST['m2'])) ? $_POST['m2'] : '';
				$m2_en 				= isset($_POST['m2_en']) ? $_POST['m2_en'] : '';
				$teaser 			= (isset($_POST['teaser']) AND !empty($_POST['teaser'])) ? $_POST['teaser'] : '';
				$teaser_en 			= (isset($_POST['teaser_en']) AND !empty($_POST['teaser_en'])) ? $_POST['teaser_en'] : '';
				$status 			= isset($_POST['status']) ? $_POST['status'] : '';
				$type 				= (isset($_POST['sell']) AND !empty($_POST['sell'])) ? '1' : '';
				$type 				= (isset($_POST['rent']) AND !empty($_POST['rent'])) ? '2' : $type;
				$multiple			= (isset($_POST['multiple']) AND !empty($_POST['multiple'])) ? true : false;
				$characteristics	= (isset($_POST['chtc']) AND !empty($_POST['chtc'])) ? explode(',', $_POST['chtc']) : '';
				$amenities			= (isset($_POST['amtg']) AND !empty($_POST['amtg'])) ? explode(',', $_POST['amtg']) : '';
				$pdf				= (isset($_POST['pdf']) AND !empty($_POST['pdf'])) ? $_POST['pdf'] : null;
				// $popular			= (isset($_POST["popular"]) AND !empty($_POST["popular"])) ? $_POST["popular"] : null;

				// if (isset($popular) AND !is_numeric($popular))
				// 	$message = 'Dato incorrecto 1';
				// else if (isset($popular) AND $popular < 1 OR isset($popular) AND $popular > 100)
				// 	$message = 'Dato incorrecto 2';

				if(!empty($_POST['sell']) AND !empty($_POST['rent']))
					$message = 'Seleccione venta o renta';

				if(empty($delivery))
					$message = 'Ingrese la entrega de la propiedad';

				if(empty($coin))
					$message = 'Seleccione un tipo de moneda';

				if(!is_numeric($price))
					$message = 'Solo ingrese números como precio de la propiedad';

				if(empty($price))
					$message = 'Ingrese el precio de la propiedad';

				if(empty($subcategory))
					$message = 'Seleccione una subcategoria';

				// if(empty($category))
				// 	$message = 'Seleccione una categoria';

				if(empty($location))
					$message = 'Seleccione una ubicación';

				if(empty($description))
					$message = 'Ingrese una descripción';

				if(empty($title))
					$message = 'Ingrese el titulo';

				if(!isset($message))
				{
					$description = json_encode([
						'es' => htmlentities($description, ENT_QUOTES | ENT_IGNORE, 'UTF-8'),
						'en' => htmlentities($description_en, ENT_QUOTES | ENT_IGNORE, 'UTF-8')
					]);

					$delivery = json_encode([
						'es' => $delivery,
						'en' => $delivery_en
					]);

					if (!empty($rooms))
					{
						$rooms = json_encode([
							'es' => $rooms,
							'en' => $rooms_en
						]);
					}

					if (!empty($m2))
					{
						$m2 = json_encode([
							'es' => $m2,
							'en' => $m2_en
						]);
					}

					if (!empty($teaser))
					{
						$teaser = json_encode([
							'es' => $teaser,
							'en' => $teaser_en
						]);
					}

					if (empty($link))
					{
						$property	= $this->model->getProperty($id_property);
						$link		= $property['cover'];
					}
					else
					{
						$link = $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);
					}

					if (!empty($pdf))
					{
						$pdf = $this->model->createPdf(str_replace(' ', '+', $pdf), PATH_IMAGES);
					}

					$editProperty = $this->model->editProperty($seo_keywords, $seo_description, $id_property, $title, $description, $price, $coin, $delivery, $rooms, $rooms_number_min, $rooms_number_max, $m2, $teaser, $type, $status, $pdf, $link, $multiple, $location, null, $subcategory, $characteristics, $amenities, null);

					if (!empty($editProperty))
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

	    		$template = $this->view->render($this, 'editProperty');
				$template = $this->format->replaceFile($template, 'topbar');
	    		$template = $this->format->replaceFile($template, 'sidebar');

				$property 					= $this->model->getProperty($id_property);
				$locations					= $this->model->getLocations();
				$categories					= $this->model->getCategories();
				$characteristics			= $this->model->getFeatures('1');
				$amenities					= $this->model->getFeatures('2');
				$propertyCharacteristics	= $this->model->getPropertyFeatures($id_property, '1');
				$propertyAmenities			= $this->model->getPropertyFeatures($id_property, '2');

				$description				= json_decode($property['description'], true);
				$delivery					= json_decode($property['delivery'], true);
				$rooms						= json_decode($property['rooms'], true);
				$m2							= json_decode($property['m2'], true);
				$teaser						= json_decode($property['teaser'], true);

				$locationsList			= '';
				$categoriesList			= '';
				$subcategoryList		= '';
				$typeMultipleList		= '';
				$statusList				= '';
				$characteristicsList	= '';
				$amenitiesList			= '';
				$pdfList				= '';
				$coinList				= '';

				$hidden					= ($property['multiple'] == true) ? 'hidden' : '';

				foreach ($locations as $location)
 				{
 					$locationsList .=
 					'<option value="' . $location['id_location'] . '" ' . (($property['id_location'] == $location['id_location']) ? 'selected' : '') . ' />' . $location['title'] . '</option>';
 				}

 				foreach ($categories as $category)
 				{
 					$categoriesList .=
 					'<option value="' . $category['id_category'] . '" ' . (($property['id_category'] == $category['id_category']) ? 'selected' : '') . ' />' . json_decode($category['title'], true)['es'] . '</option>';
 				}

 				$subcategoryList .=
				'<option value="1" ' . (($property['subcategory'] == '1') ? 'selected' : '') . ' />Preventa</option>
				<option value="2" ' . (($property['subcategory'] == '2') ? 'selected' : '') . ' />Reventa</option>
				<option value="3" ' . (($property['subcategory'] == '3') ? 'selected' : '') . ' />Terrenos</option>';

				$coinList .=
				'<option value="usd" ' . (($property['coin'] == 'usd') ? 'selected' : '') . '>USD</option>
				 <option value="mxn" ' . (($property['coin'] == 'mxn') ? 'selected' : '') . '>MXN</option>';

				$statusList .=
				'<option value="1" ' . (($property['status'] == '1') ? 'selected' : '') . '>Disponible</option>
				 <option value="2" ' . (($property['status'] == '2') ? 'selected' : '') . '>Vendido</option>
				 <option value="3" ' . (($property['status'] == '3') ? 'selected' : '') . '>Rentado</option>
				 <option value="4" ' . (($property['status'] == '4') ? 'selected' : '') . '>Apartado</option>';

				$typeMultipleList .=
				'<label class="display-block">Venta <input name="sell" type="checkbox" ' . (($property['type'] == '1') ? 'checked' : '') . '></label>
                 <label class="display-block">Renta <input name="rent" type="checkbox" ' . (($property['type'] == '2') ? 'checked' : '') . '></label>';
                 // <label class="display-block">Propiedad multiple <input name="multiple" type="checkbox" data-action="hidden" ' . (($property['multiple'] == true) ? 'checked' : '') . '></label>

				$array1 = [];
				$array2 = [];

				foreach ($propertyCharacteristics as $propertyCharacteristic)
 				{
 					array_push($array1, $propertyCharacteristic['id_feature']);
 				}

				foreach ($propertyAmenities as $propertyAmenity)
 				{
 					array_push($array2, $propertyAmenity['id_feature']);
 				}

				$stringArray1 = implode(',', $array1);
				$stringArray2 = implode(',', $array2);

				$sendArray = '<input type="text" class="hidden" data-action="sendArrays" data-array1="' . $stringArray1 . '" data-array2="' . $stringArray2 . '" />';

				foreach ($characteristics as $characteristic)
				{
					$checked = '';

					foreach ($propertyCharacteristics as $propertyCharacteristic)
					{
						if($propertyCharacteristic['id_property'] == $id_property AND $propertyCharacteristic['id_feature'] == $characteristic['id_feature'])
							$checked = 'checked';
					}

					$characteristicsList .=
					'<div class="feature">
						<input type="checkbox" data-action="sendChtc" data-id="' . $characteristic['id_feature'] . '" ' . $checked . '>
						<h6>' . json_decode($characteristic['title'], true)['es'] . '</h6>
						<div class="clear"></div>
					</div>';
				}

				foreach ($amenities as $amenity)
				{
					$checked = '';

					foreach ($propertyAmenities as $propertyAmenity)
					{
						if($propertyAmenity['id_property'] == $id_property AND $propertyAmenity['id_feature'] == $amenity['id_feature'])
							$checked = 'checked';
					}

					$amenitiesList .=
					'<div class="feature">
	                    <input type="checkbox" data-action="sendAmtg" data-id="' . $amenity['id_feature'] . '" ' . $checked . '>
	                    <h6>' . json_decode($amenity['title'], true)['es'] . '</h6>
	                    <div class="clear"></div>
	                </div>';
				}

				if(isset($property['pdf']) AND !empty($property['pdf']))
				{
					$pdfList .=
					'<div class="md--group-form">
	                    <input type="text" value="' . $property['pdf'] . '" required disabled>
	                    <span class="bar-bottom"></span>
	                    <label>Pdf actual</label>
	                    <a>Error</a>
	                </div>
					<label class="display-block"><input name="deletePdf" type="checkbox"> Eliminar Pdf</label>';
				}

				$replace = [
					'{$cover}' => '{$path.images}' . $property['cover'],
					'{$title}' => $property['title'],
					'{$description}' => $description['es'],
					'{$description_en}' => $description['en'],
					'{$locationsList}' => $locationsList,
					'{$categoriesList}' => $categoriesList,
					'{$subcategoryList}' => $subcategoryList,
					'{$price}' => $property['price'],
					'{$delivery}' => $delivery['es'],
					'{$delivery_en}' => $delivery['en'],
					'{$coinList}' => $coinList,
					'{$statusList}' => $statusList,
					'{$typeMultipleList}' => $typeMultipleList,
					'{$rooms}' => ( !is_null($rooms) ) ? $rooms['es'] : '',
					'{$rooms_number_min}' => $property['rooms_number_min'],
					'{$rooms_number_max}' => $property['rooms_number_max'],
					'{$rooms_en}' => ( !is_null($rooms) ) ? $rooms['en'] : '',
					'{$m2}' => ( !is_null($m2) ) ? $m2['es'] : '',
					'{$m2_en}' => ( !is_null($m2) ) ? $m2['en'] : '',
					'{$teaser}' => $teaser['es'],
					'{$teaser_en}' => $teaser['en'],
					'{$characteristicsList}' => $characteristicsList,
					'{$amenitiesList}' => $amenitiesList,
					'{$pdfList}' => $pdfList,
					'{$hidden}' => $hidden,
					'{$sendArray}' => $sendArray,
					'{$popular}' => $property['popular'],
					'{$seo_keywords}' => $property['seo_keywords'],
					'{$seo_description}' => $property['seo_description']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function deleteProperties()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$data = (isset($_POST['data']) AND !empty($_POST['data'])) ? $_POST['data'] : '';

				if(empty($data))
					$message = 'Seleccionar las propiedades a eliminar';

				if(!isset($message))
				{
					$data = json_decode($data);
					$data = $this->model->deleteProperties($data);

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
							'message' => 'Error to delete properties'
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

	public function editPopular($id_property)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$popular = (isset($_POST["popular"]) AND !empty($_POST["popular"])) ? $_POST["popular"] : null;

				if (isset($popular) AND !is_numeric($popular))
					$message = 'Ingrese únicamente datos numéricos';
				else if (isset($popular) AND $popular < 1 OR isset($popular) AND $popular > 100)
					$message = 'Dato no válido';

				if(!isset($message))
				{
					$query = $this->model->editPopular($id_property, $popular);

					if(!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'success',
							'message' => 'Error en la operación a la base de datos'
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

	/* subproperties
	/* ----------------------------------------------------------------------- */
	public function subproperties($id_property)
	{
		if(Session::getValue('level') > 8)
		{
			define('_title', 'LT | Administrador');

			$template = $this->view->render($this, 'subproperties');
			$template = $this->format->replaceFile($template, 'topbar');
			$template = $this->format->replaceFile($template, 'sidebar');

			$property 			= $this->model->getProperty($id_property);
			$subproperties		= $this->model->getSubproperties($id_property);

			$btnAdd				= '<a class="btn md--btn-circle" href="index.php?c=properties&m=addSubproperty&p=' . $id_property . '" data-ripple><i class="material-icons">add</i></a>';
			$subpropertiesList	= '';

			$sum = 0;

			foreach ($subproperties as $subproperty)
			{
				$sum = $sum + 1;

				$characteristics = $this->model->getPropertyFeatures($subproperty['id_property'], '1');

				if($subproperty['status'] == '1')
				{
					$status = 'Disponible';
				}
				else if($subproperty['status'] == '2')
				{
					$status = 'Vendido';
				}
				else if($subproperty['status'] == '3')
				{
					$status = 'Rentado';
				}
				else if($subproperty['status'] == '4')
				{
					$status = 'Apartado';
				}

				$rooms	= json_decode($subproperty['rooms'], true);
				$m2		= json_decode($subproperty['m2'], true);

				$subpropertiesList .=
				'<figure>
		            <img src="{$path.images}' . $subproperty['cover'] . '" alt="" />
					<input type="checkbox" data-check value="' . $subproperty['id_property'] . '" />
					<div class="buttons">
						<a href="index.php?c=properties&m=addImages&p=' . $subproperty['id_property'] . '&parent=' . $id_property . '"><i class="material-icons">photo</i></a>
						<a href="index.php?c=properties&m=editSubproperty&p=' . $subproperty['id_property'] . '&parent=' . $id_property . '"><i class="material-icons">edit</i></a>
					</div>
					<p>' . $subproperty['title'] . '</p>
		            <p>Habitaciones:<br>ES: ' . $rooms['es'] . '<br>EN: ' . $rooms['en'] . '</p>
		            <p>M2:<br>ES: ' . $m2['es'] . '<br>EN: ' . $m2['en'] . '</p>
		            <p>Estado:<br>' . $status . '</p>
					<p>Caracteristicas:</p>';

				foreach ($characteristics as $characteristic)
				{
					$feature = $this->model->getFeature($characteristic['id_feature']);
					$feature_decode = json_decode($feature['title'], true);

					$subpropertiesList .=
					'<p>* ' . $feature_decode['es'] . '</p>';
				}

				$subpropertiesList .=
		        '</figure>' . (($sum == 4) ? '<div class="clear"></div>' : '') . '';

				$sum = ($sum == 4) ? 0 : $sum;
			}

			$replace = [
				'{$title}' => $property['title'],
				'{$btnAdd}' => $btnAdd,
				'{$subpropertiesList}' => $subpropertiesList
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	public function addSubproperty($id_property)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$link				= isset($_POST['link']) ? $_POST['link'] : '';
				$title			 	= isset($_POST['title']) ? $_POST['title'] : '';
				$rooms 				= isset($_POST['rooms']) ? $_POST['rooms'] : '';
				$rooms_en 			= isset($_POST['rooms_en']) ? $_POST['rooms_en'] : '';
				$m2 				= isset($_POST['m2']) ? $_POST['m2'] : '';
				$m2_en 				= isset($_POST['m2_en']) ? $_POST['m2_en'] : '';
				$characteristics	= (isset($_POST['chtc']) AND !empty($_POST['chtc'])) ? explode(',', $_POST['chtc']) : '';

				if(empty($title))
					$message = 'Ingrese el titulo';

				if(empty($link))
					$message = 'Seleccione la imagen';

				if(!isset($message))
				{
					if (!empty($rooms))
					{
						$rooms = json_encode([
							'es' => $rooms,
							'en' => $rooms_en
						]);
					}

					if (!empty($m2))
					{
						$m2 = json_encode([
							'es' => $m2,
							'en' => $m2_en
						]);
					}

					$link = $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);

					$newSubproperty = $this->model->newSubproperty($title, $rooms, $m2, $link, $characteristics, $id_property);

					if(!empty($newSubproperty))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'index.php?c=properties&m=subproperties&p=' . $id_property
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

				$template = $this->view->render($this, 'addSubproperty');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$characteristics		= $this->model->getFeatures('1');

				$characteristicsList	= '';

				foreach ($characteristics as $characteristic)
				{
					$characteristicsList .=
					'<div class="feature">
	                    <input type="checkbox" data-action="sendChtc" data-id="' . $characteristic['id_feature'] . '">
	                    <h6>' . $characteristic['title'] . '</h6>
	                    <div class="clear"></div>
	                </div>';
				}

				$replace = [
					'{$characteristicsList}' => $characteristicsList,
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function editSubproperty($id_property)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$link				= isset($_POST['link']) ? $_POST['link'] : '';
				$title			 	= isset($_POST['title']) ? $_POST['title'] : '';
				$rooms 				= isset($_POST['rooms']) ? $_POST['rooms'] : '';
				$rooms_en 			= isset($_POST['rooms_en']) ? $_POST['rooms_en'] : '';
				$m2 				= isset($_POST['m2']) ? $_POST['m2'] : '';
				$m2_en 				= isset($_POST['m2_en']) ? $_POST['m2_en'] : '';
				$status 			= isset($_POST['status']) ? $_POST['status'] : '';
				$characteristics	= (isset($_POST['chtc']) AND !empty($_POST['chtc'])) ? explode(',', $_POST['chtc']) : '';

				if(empty($status))
					$message = 'Seleccione el status';

				if(empty($title))
					$message = 'Ingrese el titulo';

				if(!isset($message))
				{
					if (!empty($rooms))
					{
						$rooms = json_encode([
							'es' => $rooms,
							'en' => $rooms_en
						]);
					}

					if (!empty($m2))
					{
						$m2 = json_encode([
							'es' => $m2,
							'en' => $m2_en
						]);
					}

					if(empty($link))
					{
						$subproperty	= $this->model->getProperty($id_property);
						$link			= $subproperty['cover'];
					}
					else
					{
						$link = $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);
					}

					$editSubproperty = $this->model->editSubproperty($id_property, $title, $rooms, $m2, $status, $link, $characteristics);

					if(!empty($editSubproperty))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'index.php?c=properties&m=subproperties&p=' . $id_property
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

				$template = $this->view->render($this, 'editSubproperty');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$property					= $_GET['parent'];
				$subproperty 				= $this->model->getProperty($id_property);
				$characteristics 			= $this->model->getFeatures('1');
				$propertyCharacteristics	= $this->model->getPropertyFeatures($id_property, '1');

				$rooms						= json_decode($subproperty['rooms'], true);
				$m2							= json_decode($subproperty['m2'], true);

				$statusList				= '';
				$characteristicsList	= '';
				$btnReturn				= '<a class="btn md--button-flat" href="index.php?c=properties&m=subproperties&p=' . $property . '" data-ripple>Regresar</a>';

				$statusList .=
				'<option value="1" ' . (($subproperty['status'] == '1') ? 'selected' : '') . '>Disponible</option>
				 <option value="2" ' . (($subproperty['status'] == '2') ? 'selected' : '') . '>Vendido</option>
				 <option value="3" ' . (($subproperty['status'] == '3') ? 'selected' : '') . '>Rentado</option>
				 <option value="4" ' . (($subproperty['status'] == '4') ? 'selected' : '') . '>Apartado</option>';

				foreach ($characteristics as $characteristic)
				{
					$checked = '';

					foreach ($propertyCharacteristics as $propertyCharacteristic)
					{
						if($propertyCharacteristic['id_property'] == $id_property AND $propertyCharacteristic['id_feature'] == $characteristic['id_feature'])
							$checked = 'checked';
					}

					$characteristicsList .=
					'<div class="feature">
						<input type="checkbox" data-action="sendChtc" data-id="' . $characteristic['id_feature'] . '" ' . $checked . '>
						<h6>' . $characteristic['title'] . '</h6>
						<div class="clear"></div>
					</div>';
				}

				$array1 = [];

				foreach ($propertyCharacteristics as $propertyCharacteristic)
 				{
 					array_push($array1, $propertyCharacteristic['id_feature']);
 				}

				$stringArray1	= implode(',', $array1);
				$sendArray		= '<input type="text" class="hidden" data-action="sendArrays" data-array1="' . $stringArray1 . '" />';

				$replace = [
					'{$cover}' => '{$path.images}' . $subproperty['cover'],
					'{$title}' => $subproperty['title'],
					'{$rooms}' => $rooms['es'],
					'{$rooms_en}' => $rooms['en'],
					'{$m2}' => $m2['es'],
					'{$m2_en}' => $m2['en'],
					'{$statusList}' => $statusList,
					'{$characteristicsList}' => $characteristicsList,
					'{$btnReturn}' => $btnReturn,
					'{$sendArray}' => $sendArray
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	/* property-images
	/* ----------------------------------------------------------------------- */
	public function addImages($id_property)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$image	= (isset($_POST['image']) AND !empty($_POST['image'])) ? $_POST['image'] : '';

				if(empty($image))
					$message = 'empty.image';

				if(!isset($message))
				{
					$link = $this->model->createImage(str_replace(' ', '+', $image), PATH_IMAGES);

					if(!empty($link))
					{
						$addImage = $this->model->addPropertyImage($link, $id_property);

						if(!empty($addImage))
						{
							echo json_encode([
								'status' => 'success'
							]);
						}
						else
						{
							echo json_encode([
								'status' => 'error',
								'message' => 'Error to upload image'
							]);
						}
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error to upload image'
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

				$template = $this->view->render($this, 'addImages');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$images = $this->model->getPropertyImages($id_property);

				$btnAddImage	= '<a href="" data-action="addImage" data-id="' . $id_property . '"><i class="material-icons">add_circle_outline</i></a>';
				$imagesList		= '';

				foreach($images as $image)
				{
					$imagesList .=
					'<figure class="item">
			            <img src="{$path.images}' . $image['title'] . '" alt="" />
			            <a href="" data-action="deleteImage" data-id="' . $image['id_image'] . '"><i class="material-icons">delete</i></a>
			        </figure>';
				}

				$replace = [
					'{$btnAddImage}' => $btnAddImage,
					'{$imagesList}' => $imagesList
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function deleteImage()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$id				= isset($_POST['id']) ? $_POST['id'] : '';
				$deleteImage	= $this->model->deletePropertyImage($id);

				if(!empty($deleteImage))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
			}
		}
	}

	/* locations
	/* ----------------------------------------------------------------------- */
	public function locations()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$title = isset($_POST["title"]) ? $_POST["title"] : "";
				$properties = (isset($_POST["properties"]) AND !empty($_POST["properties"])) ? true : false;
				$blog = (isset($_POST["blog"]) AND !empty($_POST["blog"])) ? true : false;

				if(empty($title))
					$message = 'Ingrese la úbicación';

				if(!isset($message))
				{
					$newLocation = $this->model->newLocation($title, $properties, $blog);

					if(!empty($newLocation))
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

				$template = $this->view->render($this, 'locations');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$locations = $this->model->getLocations();

				$locationsList = '';

				foreach ($locations as $location)
				{
					$locationsList .=
					'<tr>
						<td><input type="checkbox" data-check value="' . $location['id_location'] . '" /></td>
						<td data-title="Categoria">' . $location['title'] . '</td>
						<td data-title="Categoria">' . (($location['properties'] == true) ? 'Si' : 'No') . '</td>
						<td data-title="Categoria">' . (($location['blog'] == true) ? 'Si' : 'No') . '</td>
						<td class="text-right">
							<a href="index.php?c=properties&m=editLocation&p=' . $location['id_location'] . '"><i class="material-icons">edit</i></a>
						</td>
					</tr>';
				}

				$replace = [
					'{$locationsList}' => $locationsList
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function editLocation($id_location)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$title = isset($_POST["title"]) ? $_POST["title"] : "";
				$properties = (isset($_POST["properties"]) AND !empty($_POST["properties"])) ? true : false;
				$blog = (isset($_POST["blog"]) AND !empty($_POST["blog"])) ? true : false;

				if(empty($title))
					$message = 'Ingrese el nombre de la úbicación';

				if(!isset($message))
				{
					$editLocation = $this->model->editLocation($id_location, $title, $properties, $blog);

					if(!empty($editLocation))
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

	    		$template = $this->view->render($this, 'editLocation');
				$template = $this->format->replaceFile($template, 'topbar');
	    		$template = $this->format->replaceFile($template, 'sidebar');

				$location = $this->model->getLocation($id_location);

				$lstPropertiesFlag =
				'<option value="0" ' . (($location['properties'] == false) ? 'selected' : '') . '>No</option>
				<option value="1" ' . (($location['properties'] == true) ? 'selected' : '') . '>Si</option>';

				$lstBlogFlag =
				'<option value="0" ' . (($location['blog'] == false) ? 'selected' : '') . '>No</option>
				<option value="1" ' . (($location['blog'] == true) ? 'selected' : '') . '>Si</option>';

				$replace = [
					'{$title_location}' => $location['title'],
					'{$lstPropertiesFlag}' => $lstPropertiesFlag,
					'{$lstBlogFlag}' => $lstBlogFlag
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function deleteLocations()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$data = (isset($_POST['data']) AND !empty($_POST['data'])) ? $_POST['data'] : '';

				if(empty($data))
					$message = 'Select locations to delete';

				if(!isset($message))
				{
					$data = json_decode($data);
					$data = $this->model->deleteLocations($data);

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
							'message' => 'Error to delete locations'
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

	/* categories
	/* ----------------------------------------------------------------------- */
	public function categories()
	{
		if(Session::getValue('level') > 8)
  	  	{
			if(Format::existAjaxRequest() == true)
			{
				$link			= isset($_POST['link']) ? $_POST['link'] : '';
				$title['es']	= isset($_POST['title']) ? $_POST['title'] : '';
				$title['en']	= isset($_POST['title_en']) ? $_POST['title_en'] : '';

				if(empty($title['es']) || empty($title['en']))
					$message = 'Ingrese el nombre de la categoria en los dos idiomas';

				if(empty($link))
					$message = 'Seleccione una imagen';

				if(!isset($message))
				{
					$cover			= $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);
					$title = json_encode($title);
					$newCategory	= $this->model->newCategory($title, $cover);

					if(!empty($newCategory))
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

				$template = $this->view->render($this, 'categories');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$categories = $this->model->getCategories();

				$categoriesList = '';

				foreach ($categories as $category)
				{
					$categoriesList .=
					'<tr>
						<td><input type="checkbox" data-check value="' . $category['id_category'] . '" /></td>
						<td data-title="Categoria">' . json_decode($category['title'], true)['es'] . '</td>
						<td class="text-right">
							<a href="index.php?c=properties&m=editCategory&p=' . $category['id_category'] . '"><i class="material-icons">edit</i></a>
						</td>
					</tr>';
				}

				$replace = [
					'{$categoriesList}' => $categoriesList
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
  	}

	public function editCategory($id_category)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$link			= isset($_POST['link']) ? $_POST['link'] : '';
				$title['es']	= isset($_POST['title']) ? $_POST['title'] : '';
				$title['en']	= isset($_POST['title_en']) ? $_POST['title_en'] : '';

				if(empty($title['es']) || empty($title['en']))
					$message = 'Ingrese el nombre de la categoria en los dos idiomas';

				if(!isset($message))
				{
					if(empty($link))
					{
						$category	= $this->model->getCategory($id_category);
						$link		= $category['cover'];
					}
					else
					{
						$link = $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);
					}

					$title = json_encode($title);
					$editCategory	= $this->model->editCategory($id_category, $title, $link);

					if(!empty($editCategory))
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

	    		$template = $this->view->render($this, 'editCategory');
				$template = $this->format->replaceFile($template, 'topbar');
	    		$template = $this->format->replaceFile($template, 'sidebar');

				$category = $this->model->getCategory($id_category);
				$title = json_decode($category['title'], true);

				$replace = [
					'{$cover}' => '{$path.images}' . $category['cover'],
					'{$title_es}' => $title['es'],
					'{$title_en}' => $title['en']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
  	}

	public function deleteCategories()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$data = (isset($_POST['data']) AND !empty($_POST['data'])) ? $_POST['data'] : '';

				if(empty($data))
					$message = 'Select categories to delete';

				if(!isset($message))
				{
					$data = json_decode($data);
					$data = $this->model->deleteCategories($data);

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
							'message' => 'Error to delete locations'
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

	/* features
	/* ----------------------------------------------------------------------- */
	public function features()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$title['es']	= isset($_POST["title"]) ? $_POST["title"] : "";
				$title['en']	= isset($_POST["title_en"]) ? $_POST["title_en"] : "";
				$type			= isset($_POST["type"]) ? $_POST["type"] : "";
				$icon			= isset($_POST["icon"]) ? $_POST["icon"] : "";

				if(empty($icon))
					$message = 'Ingrese un icono';

				if(empty($type))
					$message = 'Seleccione si es una caracteristica o una amenidad';

				if(empty($title['es'])  || empty($title['en']))
					$message = 'Ingrese el titulo en los dos idiomas';

				if(!isset($message))
				{
					$title = json_encode($title);
					$newFeature	= $this->model->newFeature($title, $type, $icon);

					if(!empty($newFeature))
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

				$template = $this->view->render($this, 'features');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$features = $this->model->getFeatures(null);

				$featuresList	= '';
				$type			= '';

				foreach ($features as $feature)
				{
					if($feature['type'] == '1')
					{
						$type = 'Caracteristica';
					}
					else if($feature['type'] == '2')
					{
						$type = 'Amenidad';
					}

					$featuresList .=
					'<tr>
						<td><input type="checkbox" data-check value="' . $feature['id_feature'] . '" /></td>
						<td data-title="icon">' . $feature['icon'] . '</td>
						<td data-title="title">' . json_decode($feature['title'], true)['es'] . '</td>
						<td data-title="type">' . $type . '</td>
						<td class="text-right">
							<a href="index.php?c=properties&m=editFeature&p=' . $feature['id_feature'] . '"><i class="material-icons">edit</i></a>
						</td>
					</tr>';
				}

				$replace = [
					'{$featuresList}' => $featuresList
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function editFeature($id_feature)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$feature = $this->model->getFeature($id_feature);

				$title['es']	= isset($_POST["title"]) ? $_POST["title"] : "";
				$title['en']	= isset($_POST["title_en"]) ? $_POST["title_en"] : "";
				$type			= isset($_POST["type"]) ? $_POST["type"] : "";
				$icon			= (isset($_POST["icon"]) AND !empty($_POST["icon"]))
									? $_POST["icon"] : $feature['icon'];

				if(empty($type))
					$message = 'Seleccione si es una caracteristica o una amenidad';

				if(empty($title['es']) || empty($title['en']))
					$message = 'Ingrese el titulo en los dos idiomas';

				if(!isset($message))
				{
					$title = json_encode($title);
					$editFeature = $this->model->editFeature($id_feature, $title, $type, $icon);

					if(!empty($editFeature))
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

	    		$template = $this->view->render($this, 'editFeature');
				$template = $this->format->replaceFile($template, 'topbar');
	    		$template = $this->format->replaceFile($template, 'sidebar');

				$feature = $this->model->getFeature($id_feature);
				$title = json_decode($feature['title'], true);

				$typeList =
				'<option value="1" ' . (($feature['type'] == '1') ? 'selected' : '') . '>Caracteristica</option>
				 <option value="2" ' . (($feature['type'] == '2') ? 'selected' : '') . '>Amenidad</option>';

				$replace = [
					'{$title_es}' => $title['es'],
					'{$title_en}' => $title['en'],
					'{$typeList}' => $typeList,
					'{$icon}' => $feature['icon']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
  	}

	public function deleteFeatures()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$data = (isset($_POST['data']) AND !empty($_POST['data'])) ? $_POST['data'] : '';

				if(empty($data))
					$message = 'Seleccione los items a eliminar';

				if(!isset($message))
				{
					$data = json_decode($data);
					$data = $this->model->deleteFeatures($data);

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
							'message' => 'Error to delete features'
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

	/* properties-interested
	/* ----------------------------------------------------------------------- */
	public function interested()
	{
		define('_title', 'LT | Administrador');

		$template = $this->view->render($this, 'interested');
		$template = $this->format->replaceFile($template, 'topbar');
		$template = $this->format->replaceFile($template, 'sidebar');

		$interesteds = $this->model->getPropertiesInterested();

		$interestedList = '';

		foreach($interesteds as $interested)
		{
			$property = $this->model->getProperty($interested['id_property']);

			$interestedList .=
			'<tr>
				<td data-title="property">' . $property['title'] . '</td>
				<td data-title="name">' . $interested['name'] . ' ' . $interested['lastname'] . '</td>
				<td data-title="email">' . $interested['email'] . '</td>
				<td data-title="country">' . $interested['country'] . '</td>
				<td data-title="phone">' . $interested['phone'] . '</td>
				<td data-title="date">' . $interested['date'] . '</td>
				<td data-title="observations">' . $interested['observations'] . '</td>
			</tr>';
		}

		$replace = [
			'{$interestedList}' => $interestedList
		];

		$template = $this->format->replace($replace, $template);

		echo $template;
	}
}
