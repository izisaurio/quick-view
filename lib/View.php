<?php

namespace QuickView;

/**
 * View main class
 *
 * @author  izisaurio
 * @version 1
 */
class View
{
	/**
	 * Path of file that has te template
	 *
	 * @access  private
	 * @var     string
	 */
	private $path;

	/**
	 * Elements to send to the template
	 *
	 * @access  public
	 * @var     array
	 */
	public $bag = [];

	/**
	 * Initialize path and bag
	 *
	 * @access  public
	 * @param   string  $path   Path of the template file
	 * @param   array   $bag    Elements to send to the template
	 */
	public function __construct($path, array $bag = [])
	{
		$this->path = $path;
		$this->bag = array_merge(
			[
				'_attrs' => [$this, 'attrs'],
				'_draw' => [$this, 'draw'],
				'_e' => 'htmlspecialchars',
			],
			$bag
		);
	}

	/**
	 * Adds an item to the bag
	 *
	 * @access  public
	 * @param   string  $key    Item key name
	 * @param   mixed   $value  Value of the item
	 * @return  View
	 */
	public function toBag($key, $value)
	{
		$this->bag[$key] = $value;
		return $this;
	}

	/**
	 * Helper to create an html tag attributes, usable on template as '$_attrs'
	 *
	 * @access  public
	 * @param   array   $attributes     Collection of attributes
	 * @return  string
	 */
	public function attrs(array $attributes)
	{
		$html = [];
		foreach ($attributes as $name => $value) {
			$html[] = is_int($name) ? $value : "{$name}=\"{$value}\"";
		}
		return join(' ', $html);
	}

	/**
	 * Import another tamplate to this, usable on template as '$_draw'
	 *
	 * @access  public
	 * @param   string  $path   Template file path
	 * @param   array   $bag    Elements to send to template
	 * @return  View
	 */
	public function draw($path, array $bag = [])
	{
		if (\pathinfo($path, PATHINFO_EXTENSION) === 'php') {
			return new self($path, $bag);
		}
		if (!file_exists($this->path)) {
			throw new TemplateNotFoundException($this->path);
		}
		return file_get_contents($path);
	}

	/**
	 * Render view and return the content as a string
	 *
	 * @access  public
	 * @return  string
	 * @throws  TemplateNotFoundException
	 */
	public function fetch()
	{
		if (!file_exists($this->path)) {
			throw new TemplateNotFoundException($this->path);
		}
		ob_start();
		extract($this->bag);
		require $this->path;
		$content = ob_get_clean();
		return $content;
	}

	/**
	 * To String method
	 *
	 * @access  public
	 * @return  string
	 * @throws  TemplateNotFoundException
	 */
	public function __toString()
	{
		return $this->fetch();
	}
}
