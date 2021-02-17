<?php
defined('_EXEC') or die;
class Dependencies
{
	private $status;
    private $render;
    public function __construct()
    {
        $this->render = new Render();
    }
	public function loadDependencies($data)
	{
		if(isset($this->status))
		{
			$meta 	= '';
			$css 	= '';
			$js 	= '';
			$other 	= '';
			if (isset($this->status['meta']))
			{
				foreach ($this->status['meta'] as $metatag)
					$meta .= $metatag . "\n";
			}
			if (isset($this->status['css']))
			{
				foreach ($this->status['css'] as $link)
					$css .= '<link rel="stylesheet" href="' . $link . '" type="text/css" media="all" />' . "\n";
			}
			if (isset($this->status['js']))
			{
				foreach ($this->status['js'] as $link)
					$js .= '<script src="' . $link . '"></script>' . "\n";
			}
			if (isset($this->status['other']))
			{
				foreach ($this->status['other'] as $content)
					$other .= $content . "\n";
			}
			$replace = [
				'{$dependencies.meta}' 	=> $meta,
				'{$dependencies.css}'   => $css,
				'{$dependencies.js}'    => $js,
				'{$dependencies.other}' => $other
			];
		}
		else
		{
			$replace = [
                '{$dependencies.meta}' 	=> '',
                '{$dependencies.css}'   => '',
				'{$dependencies.js}'    => '',
				'{$dependencies.other}' => ''
            ];
		}
        return $this->render->replace($replace, $data);
	}
	public function getDependencies($array)
	{
		$this->status = $array;
	}
}
