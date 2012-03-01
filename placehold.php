<?php

/**
 * Placeholder image generator
 * 
 * <code>
 * 	echo Placehold::make(array(
 * 		'width' => 150, 'height' => 200, 'text' => 'Avatar'
 * 	))->kitten()->image();
 * </code>
 * 
 * @author Phill Sparks <me@phills.me.uk>
 */
class Placehold {
	
	/**
	 * @var int  $width
	 */
	public $width   = 300;

	/**
	 * @var int  $height
	 */
	public $height  = 150;

	/**
	 * @var long  $color
	 */
	public $color   = null;

	/**
	 * @var long  $bgcolor
	 */
	public $bgcolor = null;

	/**
	 * @var string  $text
	 */
	public $text    = null;

	/**
	 * @var string  $format
	 */
	public $format  = null;

	/**
	 * @var string  $service
	 */
	public $service = 'placehold.it';

	/**
	 * Return a placeholder object.
	 * 
	 * <code>
	 * 	Placehold::make(array(
	 * 		'width' => 150, 'height' => 200, 'text' => 'Avatar'
	 * 	))->url();
	 * </code>
	 * 
	 * @param  array $opts
	 * @return string
	 */
	public static function make(array $opts = array())
	{
		return with(new static)
			->fill($opts);
	}

	/**
	 * Fluid filler.
	 * 
	 * @param  array  $values
	 * @return Placehold
	 */
	public function fill(array $values)
	{
		foreach ($values as $name => $value)
		{
			$this->set($name, $value);
		}

		return $this;
	}

	/**
	 * Fluid setter.
	 * 
	 * @param   string  $name
	 * @param   mixed   $value
	 * @return  Placehold
	 */
	public function set($name, $value)
	{
		$this->$name = $value;

		return $this;
	}

	/*
	 * Fluid Functions
	 */

	/**
	 * Fluidly set width
	 * 
	 * @param  int  $width
	 * @return Placehold
	 */
	public function width($width)
	{
		$this->width = $width;
		return $this;
	}

	/**
	 * Fluidly set height
	 * 
	 * @param  int  $height
	 * @return Placehold
	 */
	public function height($height)
	{
		$this->height = $height;
		return $this;
	}

	/**
	 * Fluidly set color
	 * 
	 * @param  long  $color
	 * @return Placehold
	 */
	public function color($color)
	{
		$this->color = $color;
		return $this;
	}

	/**
	 * Fluidly set bgcolor
	 * 
	 * @param  long  $color
	 * @return Placehold
	 */
	public function bgcolor($bgcolor)
	{
		$this->bgcolor = $bgcolor;
		return $this;
	}

	/**
	 * Fluidly set text
	 * 
	 * @param  string  $text
	 * @return Placehold
	 */
	public function text($text)
	{
		$this->text = $text;
		return $this;
	}

	/**
	 * Fluidly set format
	 * 
	 * @param  string  $format
	 * @return Placehold
	 */
	public function format($format)
	{
		$this->format = $format;
		return $this;
	}

	/**
	 * Fluidly set format = jpg
	 * 
	 * @return Placehold
	 */
	public function jpg()
	{
		$this->format = 'jpg';
		return $this;
	}

	/**
	 * Fluidly set format = jpeg
	 * 
	 * @return Placehold
	 */
	public function jpeg()
	{
		$this->format = 'jpeg';
		return $this;
	}

	/**
	 * Fluidly set format = png
	 * 
	 * @return Placehold
	 */
	public function png()
	{
		$this->format = 'png';
		return $this;
	}

	/**
	 * Fluidly set format = gif
	 * 
	 * @return Placehold
	 */
	public function gif()
	{
		$this->format = 'gif';
		return $this;
	}

	/**
	 * Fluidly set service
	 * 
	 * @param  string
	 * @return Placehold
	 */
	public function service($service)
	{
		$this->service = $service;
		return $this;
	}

	/**
	 * Fluidly set service = placehold.it
	 * 
	 * @return Placehold
	 */
	public function it()
	{
		$this->service = 'placehold.it';
		return $this;
	}

	/**
	 * Fluidly set service = placekitten
	 * 
	 * @return Placehold
	 */
	public function kitten()
	{
		$this->service = 'placekitten';
		return $this;
	}

	/**
	 * Get the URL
	 * 
	 * @return string
	 */
	public function url()
	{
		switch ($this->service)
		{
			case 'placehold':
			case 'placehold.it':
				$url = 'http://placehold.it/'.$this->width;
				if ($this->width !== $this->height) $url .= 'x'.$this->height;
				if ($this->bgcolor) $url .= '/'.$this->bgcolor;
				if ($this->color)   $url .= '/'.$this->color;
				if ($this->format)  $url .= '.'.$this->format;
				if ($this->text)    $url .= '&text='.urlencode($this->text);
				return $url;
			break;
			case 'placekitten':
				$grey = str_repeat(substr($this->bgcolor, 0, 1), strlen($this->bgcolor));

				$url = 'http://placekitten.com/'
				if ($this->bgcolor == $grey) $url .= 'g/';
				$url .= $this->width.'/'.$this->height;
				return $url;
			break;
		}
		return '';
	}

	/**
	 * Get the image HTML
	 * 
	 * @return string
	 */
	public function image()
	{
		return '<img src="'. $this->url() .'" width="'. $this->width .'" height="'. $this->height .'" alt="'.htmlspecialchars($this->text ?: 'Placeholder').'" />';
	}

}