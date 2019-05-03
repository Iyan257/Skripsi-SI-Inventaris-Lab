<?php

/**
 * Simple layouting library.
 */
class Layout
{

    /**
     * CodeIgniter instance.
     *
     * @var mixed
     */
    private $CI;

    /**
     * Layout's config.
     *
     * @var array
     */
    private $config;

    /**
     * Default values to bind.
     *
     * @var array
     */
    private $defaults;

    /**
     * Appended values to bind.
     *
     * @var array
     */
    private $data;

    /**
     * Template data to use.
     *
     * @var array
     */
    private $template;

    /**
     * Cleaned template location.
     *
     * @var string
     */
    private $template_location;

    /**
     * View to use.
     *
     * @var string
     */
    private $view;

    /**
     * Layout constructor.
     */
    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->config('layout', true);
        $this->config = $this->CI->config->config['layout'];

        $this->data = [];
        $this->defaults = $this->config['default_values'];
        $this->template_location = trim($this->config['template_location'], '/') . '/';
        $this->template($this->config['default_template']);
    }

    /**
     * Binds a value.
     *
     * @param string $key   A key.
     * @param mixed  $value A value to bind.
     * @return Layout
     */
    public function bind($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * Binds values.
     *
     * @param array $values Values to bind.
     * @return Layout
     */
    public function with($values)
    {
        $this->data = \array_merge($this->data, $values);
        return $this;
    }

    /**
     * Uses a template
     *
     * @param string $template Template name.
     * @return Layout
     */
    public function template($template)
    {
        $this->template = $this->template_location . $template;
        return $this;
    }

    /**
     * Does something before start rendering view.
     *
     * @return void
     */
    private function prepare($view, $data)
    {
        $this->data = \array_merge($this->defaults, $this->data, $data);
        $this->view = $view;
    }

    /**
     * Does something after rendering view is complete.
     *
     * @return void
     */
    private function clean()
    {
        $this->data = [];
        $this->template($this->config['default_template']);
    }

    /**
     * Renders a view.
     *
     * @param string $view A view to render.
     * @return void
     */
    public function render($view, $data = [])
    {
        $this->prepare($view, $data);
        $this->CI->load->view($this->template, $this->data);
        $this->clean();
    }

    /**
     * Defines a section (load a subview). Section load order is:
     *   1. From views/$section directory.
     *   2. From template_location/$section directory.
     *
     * @param string $section A view to load.
     * @return void
     */
    public function section($section = '')
    {
        switch (true) {
            case file_exists(VIEWPATH . $this->view . ($section != ''? DIRECTORY_SEPARATOR : '') . $section . '.php'):
                $section = $this->view . ($section != ''? DIRECTORY_SEPARATOR : ''). $section;
                break;
            case file_exists(VIEWPATH . $this->template_location . DIRECTORY_SEPARATOR . $section . '.php'):
                $section = $this->template_location . DIRECTORY_SEPARATOR . $section;
                break;
            default:
                return;
        }

        $this->CI->load->view($section);
    }

    /**
     * Loads $this->view view. Basically an alias of section().
     *
     * @return void
     */
    public function content() {
        $this->section();
    }
}
