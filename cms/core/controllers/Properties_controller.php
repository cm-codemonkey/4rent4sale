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
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Properties_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
	* @since October 30 / November 14, 2018 <1.0.0> <@update>
	* @version 1.0.0
	* @summary Se anexarón las funcionalidades de tipo de propiedad (multiple/sencilla) y detalles.
	*/

	/* Ajax 1: Create or edit properties
	** Ajax 2: Get properties
	** Ajax 2: Delete properties selection
	** Render: Properties page
	------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'new' OR $action == 'edit')
			{
				$id_property = ($action == 'edit') ? $_POST['id_property'] : null;

				$name_es = (isset($_POST['name_es']) AND !empty($_POST['name_es'])) ? $_POST['name_es'] : null;
				$name_en = (isset($_POST['name_en']) AND !empty($_POST['name_en'])) ? $_POST['name_en'] : null;
				$description_es = (isset($_POST['description_es']) AND !empty($_POST['description_es'])) ? $_POST['description_es'] : null;
				$description_en = (isset($_POST['description_en']) AND !empty($_POST['description_en'])) ? $_POST['description_en'] : null;
				$type = (isset($_POST['type']) AND !empty($_POST['type'])) ? $_POST['type'] : null;
				$price = (isset($_POST['price']) AND !empty($_POST['price'])) ? $_POST['price'] : null;
				$dimensions_es = (isset($_POST['dimensions_es']) AND !empty($_POST['dimensions_es'])) ? $_POST['dimensions_es'] : null;
				$dimensions_en = (isset($_POST['dimensions_en']) AND !empty($_POST['dimensions_en'])) ? $_POST['dimensions_en'] : null;
				$characteristics = (isset($_POST['characteristics']) AND !empty($_POST['characteristics'])) ? json_decode($_POST['characteristics'], true) : null;
				$amenities = (isset($_POST['amenities']) AND !empty($_POST['amenities'])) ? json_decode($_POST['amenities'], true) : null;
				$dtype = (isset($_POST['dtype']) AND !empty($_POST['dtype'])) ? $_POST['dtype'] : null;
				$status = (isset($_POST['status']) AND !empty($_POST['status'])) ? true : false;
				$latitud = (isset($_POST['lat']) AND !empty($_POST['lat'])) ? $_POST['lat'] : null;
				$longitud = (isset($_POST['lng']) AND !empty($_POST['lng'])) ? $_POST['lng'] : null;
				$category = (isset($_POST['category']) AND !empty($_POST['category'])) ? $_POST['category'] : null;
				$location = (isset($_POST['location']) AND !empty($_POST['location'])) ? $_POST['location'] : null;
				$background = (isset($_FILES['background']['name']) AND !empty($_FILES['background']['name'])) ? $_FILES['background'] : null;
				$pdf = (isset($_POST['pdf']) AND !empty($_POST['pdf'])) ? $_POST['pdf'] : null;
				$priority = (isset($_POST['priority']) AND !empty($_POST['priority'])) ? $_POST['priority'] : null;

				$errors = [];

				if (!isset($name_es))
					array_push($errors, ['name_es', 'No deje este campo vacío']);

				if (!isset($name_en))
					array_push($errors, ['name_en', 'No deje este campo vacío']);

				if (!isset($description_es) AND isset($description_en))
					array_push($errors, ['description_es', 'No deje este campo vacío']);

				if (!isset($description_en) AND isset($description_es))
					array_push($errors, ['description_en', 'No deje este campo vacío']);

				if (!isset($type))
					array_push($errors, ['type', 'Seleccione una opción']);

				if ($type == 'simple' AND !isset($price))
					array_push($errors, ['price', 'No deje este campo vacío']);

				if ($type == 'simple' AND !isset($dimensions_es))
					array_push($errors, ['dimensions_es', 'No deje este campo vacío']);

				if ($type == 'simple' AND !isset($dimensions_en))
					array_push($errors, ['dimensions_en', 'No deje este campo vacío']);

				if ($type == 'simple' AND !isset($dtype))
					array_push($errors, ['dtype', 'Seleccione una opción']);

				if ($type == 'simple' AND !isset($status))
					array_push($errors, ['status', 'Seleccione una opción']);

				if (!isset($latitud) AND isset($longitud))
					array_push($errors, ['latitud', 'No deje este campo vacío']);

				if (!isset($longitud) AND isset($latitud))
					array_push($errors, ['longitud', 'No deje este campo vacío']);

				if (!isset($category))
					array_push($errors, ['category', 'Seleccione una opción']);

				if (!isset($location))
					array_push($errors, ['location', 'Seleccione una opción']);

				if ($action == 'new' AND !isset($background))
					array_push($errors, ['background', 'No deje este campo vacío']);

				if (isset($priority) AND $priority < 0)
					array_push($errors, ['priority', 'No ingrese numeros negativos']);

				if (empty($errors))
				{
					$details = [];

					if ($type == 'simple')
					{
						array_push($details, [
							'position' => 1,
							'name' => null,
							'price' => $price,
							'dimensions' => [
								'es' => $dimensions_es,
								'en' => $dimensions_en
							],
							'characteristics' => $characteristics,
							'amenities' => $amenities,
							'available' => $status,
							'type' => $dtype,
							'background' => null
						]);
					}

					if (isset($pdf) AND !empty($pdf))
						$pdf = $this->model->uploader(str_replace(' ', '+', $pdf), PATH_UPLOADS, '.pdf');

					$property = [
						'id_property' => $id_property,
						'name' => json_encode([
							'es' => $name_es,
							'en' => $name_en
						]),
						'description' => json_encode([
							'es' => $description_es,
							'en' => $description_en
						]),
						'type' => $type,
						'details' => json_encode($details),
						'map' => json_encode([
							'lat' => $latitud,
							'lng' => $longitud
						]),
						'id_property_category' => $category,
						'id_property_location' => $location,
						'background' => $background,
						'pdf' => $pdf,
						'priority' => $priority
					];

					if ($action == 'new')
						$query = $this->model->new_property($property);
					else if ($action == 'edit')
						$query = $this->model->edit_property($property);

					if (!empty($query))
					{
						if ($action == 'new')
						{
							$subscriptions = $this->model->get_subscriptions();
							$contact = $this->model->get_contact();

							$header_mail  = 'MIME-Version: 1.0' . "\r\n";
						    $header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
						    $header_mail .= 'From: Tierra Pitaya <' . $contact['email'] . '>' . "\r\n";

							$subject_mail = '¡Revisa nuestra nueva propiedad!';

							$body_mail =
							'<html>
								<head>
									<title>' . $subject_mail . '</title>
								</head>
								<body>
									<article style="width:600px;padding:20px;box-sizing:border-box;background-color:#eee;">
										<header style="width:100%;padding:40px;box-sizing:border-box;border-bottom:1px solid #eee;background-color:#fff;">
											<figure style="width:520px;padding:0px;margin:0px;overflow:hidden;text-align:center;">
												<img style="height:50px;" src="https://tierrapitaya.com/images/logotype_black.png" />
											</figure>
										</header>
										<aside style="width:100%;padding:40px;box-sizing:border-box;background-color:#fff;">
											<figure style="width:100%;padding:0px;margin:0px;margin-bottom:10px;overflow:hidden;text-align:center;">
												<img style="width:100%;" src="https://tierrapitaya.com/images/properties/' . $property['background'] . '" />
											</figure>
											<h6 style="margin:0px;margin-bottom:30px;padding:0px;font-size:14px;font-weight:300;color:#757575;">' . json_decode($property['name'], true)['es'] . ' | <a href="https://tierrapitaya.com/properties/more/' . $query  . '/' . json_decode($property['name'], true)['es']  . '">Ver propiedad</a></h6>
											<p style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">' . $subject_mail . '</p>
										</aside>
										<footer style="width:100%;padding:40px;box-sizing:border-box;border-top:1px solid #eee;background-color:#fff;">
											<a href="https://tierrapitaya.com/" style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">www.tierrapitaya.com</a>
										</footer>
									 </article>
								 </body>
							</html>';

							foreach ($subscriptions as $subscription)
								mail($subscription['email'], $subject_mail, $body_mail, $header_mail);
						}

						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'labels' => $errors
					]);
				}
			}

			if ($action == 'get')
			{
				$query = $this->model->get_property_by_id($_POST['id_property']);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success',
						'data' => $query
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}

			if ($action == 'delete')
			{
				$query = $this->model->delete_properties(json_decode($_POST['data']));

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}
		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'index');

			$properties = $this->model->get_properties();
			$categories = $this->model->get_properties_categories();
			$locations = $this->model->get_properties_locations();

			$lst_properties = '';
			$lst_categories = '';
			$lst_locations = '';

			foreach ($properties as $property)
			{
				$details = json_decode($property['details'], true);
				$property_gallery = $this->model->get_property_gallery($property['id_property']);

				$lst_properties .=
				'<tr>
					<td><input type="checkbox" data-check value="' . $property['id_property'] . '" /></td>
					<td><figure>' .((!empty($property['background'])) ?'<img src="../{$path.images}properties/' . $property['background'] . '" />' : '<img src="images/empty.png" />') . '</figure></td>
					<td>' . json_decode($property['name'], true)['es'] . '</td>
					<td>' .  (($property['type'] == 'simple') ? '$ ' . number_format($details[0]['price'], 0, '.', ',') . ' USD' : '- - -') . '</td>
					<td>' . json_decode($property['category'], true)['es'] . '</td>
					<td>' . json_decode($property['location'], true)['es'] . '</td>
					<td>' . (($property['type'] == 'multiple') ? '<span class="success">Multiple</span>' : '<span class="empty">Sencilla</span>') . '</td>
					<td>' . (($property['priority'] >= 1) ? '<span class="busy">Destacado ' . $property['priority'] . '</span>' : '<span class="empty">No Destacado</span>') . '</td>
					<td>
						<a href="" data-action="get_property_to_edit" data-id="' . $property['id_property'] . '" data-flag="property"><i class="material-icons">menu</i><span>Detalles | Editar</span></a>
						<a href="index.php?c=properties&m=gallery&p=' . $property['id_property'] . '"><i class="material-icons">photo</i><span>Galería (' . count($property_gallery) . ' Imágenes)</span></a>
						' . (($property['type'] == 'multiple') ? '<a href="index.php?c=properties&m=details&p=' . $property['id_property'] . '"><i class="material-icons">details</i><span>Detalles (' . count($details) . ' items)</span></a>' : '') . '
						<div class="clear"></div>
					</td>
				</tr>';
			}

			foreach ($categories as $category)
				$lst_categories .= '<option value="' . $category['id_property_category'] . '">' . json_decode($category['name'], true)['es'] . '</option>';

			foreach ($locations as $location)
				$lst_locations .= '<option value="' . $location['id_property_location'] . '">' . json_decode($location['name'], true)['es'] . '</option>';

			$replace = [
				'{$lst_properties}' => $lst_properties,
				'{$lst_categories}' => $lst_categories,
				'{$lst_locations}' => $lst_locations
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	/**
	* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
	* @since November 13, 2018 <1.0.0> <@create>
	* @version 1.0.0
	* @summary Submódulo de detalles de propiedad multiple.
	*/

	/* Ajax 1: Create or edit details
	** Ajax 2: Get details
	** Ajax 2: Delete details selection
	** Render: Details page
	------------------------------------------------------------------------------- */
	public function details($id_property)
	{
		$property = $this->model->get_property_by_id($id_property);
		$details = json_decode($property['details'], true);

		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'new' OR $action == 'edit')
			{
				$id_details = ($action == 'edit') ? $_POST['id_details'] : null;

				$position = (isset($_POST['position']) AND !empty($_POST['position'])) ? $_POST['position'] : null;
				$name_es = (isset($_POST['name_es']) AND !empty($_POST['name_es'])) ? $_POST['name_es'] : null;
				$name_en = (isset($_POST['name_en']) AND !empty($_POST['name_en'])) ? $_POST['name_en'] : null;
				$price = (isset($_POST['price']) AND !empty($_POST['price'])) ? $_POST['price'] : null;
				$dimensions_es = (isset($_POST['dimensions_es']) AND !empty($_POST['dimensions_es'])) ? $_POST['dimensions_es'] : null;
				$dimensions_en = (isset($_POST['dimensions_en']) AND !empty($_POST['dimensions_en'])) ? $_POST['dimensions_en'] : null;
				$characteristics = (isset($_POST['characteristics']) AND !empty($_POST['characteristics'])) ? json_decode($_POST['characteristics'], true) : null;
				$amenities = (isset($_POST['amenities']) AND !empty($_POST['amenities'])) ? json_decode($_POST['amenities'], true) : null;
				$type = (isset($_POST['dtype']) AND !empty($_POST['dtype'])) ? $_POST['dtype'] : null;
				$status = (isset($_POST['status']) AND !empty($_POST['status'])) ? true : false;
				$background = (isset($_FILES['background']['name']) AND !empty($_FILES['background']['name'])) ? $_FILES['background'] : null;

				$errors = [];

				if (!isset($position))
					array_push($errors, ['position', 'No deje este campo vacío']);

				if (!isset($name_es))
					array_push($errors, ['name_es', 'No deje este campo vacío']);

				if (!isset($name_en))
					array_push($errors, ['name_en', 'No deje este campo vacío']);

				if (!isset($price))
					array_push($errors, ['price', 'No deje este campo vacío']);

				if (!isset($dimensions_es))
					array_push($errors, ['dimensions_es', 'No deje este campo vacío']);

				if (!isset($dimensions_en))
					array_push($errors, ['dimensions_en', 'No deje este campo vacío']);

				if (!isset($type))
					array_push($errors, ['dtype', 'Seleccione una opción']);

				if (!isset($status))
					array_push($errors, ['status', 'Seleccione una opción']);

				if ($action == 'new' AND !isset($background))
					array_push($errors, ['background', 'No deje este campo vacío']);

				if (empty($errors))
				{
					$edetails = [
						'id_property' => $id_property,
						'id_details' => $id_details,
						'position' => $position,
						'name' => [
							'es' => $name_es,
							'en' => $name_en,
						],
						'price' => $price,
						'dimensions' => [
							'es' => $dimensions_es,
							'en' => $dimensions_en
						],
						'characteristics' => $characteristics,
						'amenities' => $amenities,
						'available' => $status,
						'type' => $type,
						'background' => $background,
						'details' => $details
					];

					if ($action == 'new')
						$query = $this->model->new_property_details($edetails);
					else if ($action == 'edit')
						$query = $this->model->edit_property_details($edetails);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'labels' => $errors
					]);
				}
			}

			if ($action == 'get')
			{
				echo json_encode([
					'status' => 'success',
					'data' => $details[$_POST['id_details']]
				]);
			}

			if ($action == 'delete')
			{
				unset($details[$_POST['id_details']]);

				if (!empty($details))
				{
					foreach ($details as $key => $row)
						$aux[$key] = $row['position'];

					array_multisort($aux, SORT_ASC, $details);
				}

				$query = $this->model->delete_property_details($id_property, json_encode($details));

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}
		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'details');

			$lst_details = '';

			$cicle = 0;

			foreach ($details as $details)
			{
				$lst_details .=
				'<tr>
					<td><figure>' .((!empty($details['background'])) ?'<img src="../{$path.images}properties/' . $details['background'] . '" />' : '<img src="../{$path.images}empty.png" />') . '</figure></td>
					<td>' . $details['position'] . '. ' . $details['name']['es'] . '</td>
					<td>$ ' . number_format($details['price'], 0, '.', ',') . ' USD</td>
					<td>' . $details['dimensions']['es'] . '</td>';

				if (isset($details['characteristics']) AND !empty($details['characteristics']))
				{
					$lst_details .= '<td>';

					foreach ($details['characteristics'] as $characteristic)
						$lst_details .= '<span>' . $characteristic['es'] . '</span>, ';

					$lst_details .= '</td>';
				}
				else
					$lst_details .= '<td>Sin características</td>';

				if (isset($details['amenities']) AND !empty($details['amenities']))
				{
					$lst_details .= '<td>';

					foreach ($details['characteristics'] as $amenity)
						$lst_details .= '<span>' . $amenity['es'] . '</span>, ';

					$lst_details .= '</td>';
				}
				else
					$lst_details .= '<td>Sin amenidades</td>';

				$lst_details .=
				'	<td>' . (($details['type'] == 'sale') ? '<span class="busy">Venta</span>' : '<span class="empty">Renta</span>') . '</td>
					<td>' . (($details['available'] == true) ? '<span class="success">Disponible</span>' : '<span class="alert">No disponible</span>') . '</td>
					<td>
						<a href="" data-button-modal="delete_details" data-id="' . $cicle . '"><i class="material-icons">delete</i><span>Eliminar</span></a>
						<a href="" data-action="get_property_to_edit" data-id="' . $cicle . '" data-flag="details"><i class="material-icons">menu</i><span>Detalles | Editar</span></a>
						<div class="clear"></div>
					</td>
				</tr>';

				$cicle = $cicle + 1;
			}

			$replace = [
				'{$name}' => json_decode($property['name'], true)['es'],
				'{$lst_details}' => $lst_details
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	/**
	* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
	* @since October 04, 2018 <1.0.0> <@create>
	* @version 1.0.0
	* @summary Submódulo de categorías
	*/

	/* Ajax 1: Create or edit category
	** Ajax 2: Get categories
	** Ajax 2: Delete categories selection
	** Render: Categories page
	------------------------------------------------------------------------------- */
	public function categories()
	{
	    if (Format::exist_ajax_request() == true)
	    {
	        $action	= $_POST['action'];

	        if ($action == 'new' OR $action == 'edit')
	        {
	            $id_property_category = ($action == 'edit') ? $_POST['id_property_category'] : null;

	            $name_es = (isset($_POST['name_es']) AND !empty($_POST['name_es'])) ? $_POST['name_es'] : null;
	            $name_en = (isset($_POST['name_en']) AND !empty($_POST['name_en'])) ? $_POST['name_en'] : null;
				$background = (isset($_FILES['background']['name']) AND !empty($_FILES['background']['name'])) ? $_FILES['background'] : null;
				$priority = (isset($_POST['priority']) AND !empty($_POST['priority'])) ? $_POST['priority'] : null;

	            $errors = [];

	            if (!isset($name_es))
	                array_push($errors, ['name_es', 'No deje este campo vacío']);

	            if (!isset($name_en))
	                array_push($errors, ['name_en', 'No deje este campo vacío']);

	            if (empty($errors))
	            {
	                $category = [
	                    'id_property_category' => $id_property_category,
	                    'name' => json_encode(['es' => $name_es, 'en' => $name_en]),
						'background' => $background,
						'priority' => $priority
	                ];

	                if ($action == 'new')
	                    $query = $this->model->new_property_category($category);
	                else if ($action == 'edit')
	                    $query = $this->model->edit_property_category($category);

	                if (!empty($query))
	                {
	                    echo json_encode([
	                        'status' => 'success'
	                    ]);
	                }
	                else
	                {
	                    echo json_encode([
	                        'status' => 'error',
	                        'message' => 'DATABASE OPERATION ERROR'
	                    ]);
	                }
	            }
	            else
	            {
	                echo json_encode([
	                    'status' => 'error',
	                    'labels' => $errors
	                ]);
	            }
	        }

	        if ($action == 'get')
	        {
	            $query = $this->model->get_property_category_by_id($_POST['id_property_category']);

	            if (!empty($query))
	            {
	                echo json_encode([
	                    'status' => 'success',
	                    'data' => $query
	                ]);
	            }
	            else
	            {
	                echo json_encode([
	                    'status' => 'error',
	                    'message' => 'DATABASE OPERATION ERROR'
	                ]);
	            }
	        }

	        if ($action == 'delete')
	        {
	            $query = $this->model->delete_categories(json_decode($_POST['data']));

	            if (!empty($query))
	            {
	                echo json_encode([
	                    'status' => 'success'
	                ]);
	            }
	            else
	            {
	                echo json_encode([
	                    'status' => 'error',
	                    'message' => 'DATABASE OPERATION ERROR'
	                ]);
	            }
	        }

	    }
	    else
	    {
	        define('_title', '{$lang.title}');

	        $template = $this->view->render($this, 'categories');

	        $categories = $this->model->get_properties_categories();

	        $lst_categories	= '';

	        foreach ($categories as $category)
	        {
	            $lst_categories .=
	            '<tr>
	                <td><input type="checkbox" data-check value="' . $category['id_property_category'] . '" /></td>
					<td><figure>' . ((!empty($category['background'])) ? '<img src="../{$path.images}properties/categories/' . $category['background'] . '" />' : '<img src="../{$path.images}empty.png" />') . '</figure></td>
					<td>' . json_decode($category['name'], true)['es'] . '</td>
					<td>' . (($category['priority'] >= 1) ? '<span class="busy">Prioridad '. $category['priority'] .'</span>' : '<span class="empty">Sin Prioridad</span>') . '</td>
	                <td>
	                    <a data-action="get_category_to_edit" data-id="' . $category['id_property_category'] . '"><i class="material-icons">menu</i><span>Detalles / Editar</span></a>
	                </td>
	            </tr>';
	        }

	        $replace = [
	            '{$lst_categories}' => $lst_categories
	        ];

	        $template = $this->format->replace($replace, $template);

	        echo $template;
	    }
	}

	/* Ajax 1: Create or edit Location
	** Ajax 2: Get Locations
	** Ajax 2: Delete Locations selection
	** Render: Locations page
	------------------------------------------------------------------------------- */
	public function locations()
	{
		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'new' OR $action == 'edit')
			{
				$id_property_location = ($action == 'edit') ? $_POST['id_property_location'] : null;

				$name_es = (isset($_POST['name_es']) AND !empty($_POST['name_es'])) ? $_POST['name_es'] : null;
				$name_en = (isset($_POST['name_en']) AND !empty($_POST['name_en'])) ? $_POST['name_en'] : null;

				$errors = [];

				if (!isset($name_es))
					array_push($errors, ['name_es', 'No deje este campo vacío']);

				if (!isset($name_en))
					array_push($errors, ['name_en', 'No deje este campo vacío']);

				if (empty($errors))
				{
					$location = [
						'id_property_location' => $id_property_location,
						'name' => json_encode(['es' => $name_es, 'en' => $name_en])
					];

					if ($action == 'new')
						$query = $this->model->new_property_location($location);
					else if ($action == 'edit')
						$query = $this->model->edit_property_location($location);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'labels' => $errors
					]);
				}
			}

			if ($action == 'get')
			{
				$query = $this->model->get_property_location_by_id($_POST['id_property_location']);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success',
						'data' => $query
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}

			if ($action == 'delete')
			{
				$query = $this->model->delete_locations(json_decode($_POST['data']));

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}

		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'locations');

			$locations = $this->model->get_properties_locations();

			$lst_locations	= '';

			foreach ($locations as $location)
			{
				$lst_locations .=
				'<tr>
					<td><input type="checkbox" data-check value="' . $location['id_property_location'] . '" /></td>
					<td>' . json_decode($location['name'], true)['es'] . '</td>
					<td>
						<a data-action="get_location_to_edit" data-id="' . $location['id_property_location'] . '"><i class="material-icons">menu</i><span>Detalles / Editar</span></a>
					</td>
				</tr>';
			}

			$replace = [
				'{$lst_locations}' => $lst_locations
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	/**
	* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
	* @since October 04, 2018 <1.0.0> <@create>
	* @version 1.0.0
	* @summary Submódulo de galería
	*/

	/* Ajax 1: Upload image to gallery
	** Ajax 2: Delete image to gallery
	** Render: Gallery page
	------------------------------------------------------------------------------- */
	public function gallery($id_property)
	{
		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'new')
			{
				$name = $this->model->uploader(str_replace(' ', '+', $_POST['image']), PATH_IMAGES . 'properties/gallery/');

				if (!empty($name))
				{
					$query = $this->model->new_gallery_image($name, $id_property);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'UPLOADER ERROR'
					]);
				}
			}

			if ($action == 'delete')
			{
				$query = $this->model->delete_gallery_image($_POST['id_gallery_image']);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}
		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'gallery');

			$gallery = $this->model->get_property_gallery($id_property);

			$lst_gallery_images	= '';

			foreach ($gallery as $image)
			{
				$lst_gallery_images .=
				'<figure class="item">
					<img src="../{$path.images}properties/gallery/' . $image['name'] . '" alt="" />
					<a href="" data-action="delete_gallery_image" data-id="' . $image['id_gallery_image'] . '"><i class="material-icons">delete</i></a>
				</figure>';
			}

			$replace = [
				'{$lst_gallery_images}' => $lst_gallery_images
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
