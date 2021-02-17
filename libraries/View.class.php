<?php
defined('_EXEC') or die;

class View
{
	private $dependencies;
	private $security;
	private $format;

	public function __construct()
	{
		$this->dependencies = new Dependencies();
		$this->security = new Security();
		$this->format = new Format();
	}

	public function render($controller, $layout, $landing = false, $self = true)
	{
		$pathLayouts = $this->security->directorySeparator($this->format->checkAdmin(PATH_ADMINISTRATOR_LAYOUTS, PATH_LAYOUTS));

		ob_start();

		// Load Header
		if($landing === FALSE)
        	require_once $pathLayouts . 'head.php';

        // Load Main
		if($self === TRUE)
        	$controller = str_replace(CONTROLLER_PHP, '', get_class($controller));
        require $pathLayouts . $controller . '/' . $layout . '.php';

        // Load Footer
		if($landing === FALSE)
        	require_once $pathLayouts . 'footer.php';

        $buffer = ob_get_contents();

		# Code render
		$buffer = $this->dependencies->loadDependencies($buffer);

        ob_end_clean();

        return $buffer;
	}

}
