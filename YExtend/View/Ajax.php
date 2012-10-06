<?php

class YExtend_View_Ajax implements Yaf_View_Interface
{
    /**
     * List of Variables which will be replaced in the
     * template
     * @var array
     */
    protected $_tpl_vars = array();

    /**
      * Options
      */
    protected $_options = array();

    /**
     * Constructor.
     *
     * @param array $config Configuration key-value pairs.
     */
    public function __construct( $templateDir = '', $options = array() )
    {
        $this->_options = $options;
    }

    /**
     * Assigns variables to the view script via differing strategies.
     *
     * Yaf_View_Simple::assign('name', $value) assigns a variable called 'name'
     * with the corresponding $value.
     *
     * Yaf_View_Simple::assign($array) assigns the array keys as variable
     * names (with the corresponding array values).
     *
     * @see    __set()
     * @param  string|array The assignment strategy to use.
     * @param  mixed (Optional) If assigning a named variable, use this
     * as the value.
     * @return Yaf_View_Simple
     * @throws Yaf_Exception_LoadFailed_View if $name is
     * neither a string nor an array,
     */
    public function assign( $name, $value = null )
    {
        // which strategy to use?
        if ( is_string( $name ) )
        {
            // assign by name and value
            $this->_tpl_vars[ $name ] = $value;
        }
        elseif ( is_array( $name ) )
        {
            // assign from associative array
            foreach ( $name as $key => $val )
            {
                $this->_tpl_vars[ $key ] = $val;
            }
        }
        else
        {
            throw new Yaf_Exception( 'assign() expects a string or array, received ' . gettype( $name ) );
        }
        return $this;
    }

    /**
     * Set the path to find the view script used by render()
     *
     * @param string The directory to set as the path.
     * @return void
     */
    public function setScriptPath( $templateDir )
    {
        return $this;
    }

    /**
     * Return path to find the view script used by render()
     *
     * @return null|string Null if script not found
     */
    public function getScriptPath()
    {
        return null;
    }

    /**
     * Processes a view script and displays the output.
     *
     * @param string $tpl The script name to process.
     * @param string $tpl_vars The variables to use in the view.
     * @return string The script output.
     */
    public function display( $tpl, $tplVars = array() )
    {
        echo $this->render( $template, $tplVars );
        return true;
    }

    /**
     * return the assigned template variable
     *
     * @param  string $name
     * @return null
     */
    public function __get( $name )
    {
        return isset( $this->_tpl_vars[$name] ) ? $this->_tpl_vars[$name] : null;
    }

    /**
     * Allows testing with empty() and isset() to work inside
     * templates.
     *
     * @param  string $key
     * @return boolean
     */
    public function __isset( $name )
    {
        return isset( $this->_tpl_vars[ $name ] );
    }

    /**
     * Assigns a variable or an associative array to the view script.
     * @see assign()
     *
     * @param string $name The variable name or array.
     * @param mixed $value The variable value.
     * @return void
     */
    public function __set( $name, $value )
    {
        return $this->assign( $name, $value );
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset( $name )
    {
        if ( isset( $this->_tpl_vars[ $name ] ) )
        {
            unset( $this->_tpl_vars[ $name ] );
        }
    }



    /**
     * Processes a view script and returns the output.
     *
     * @param string $tpl The script name to process.
     * @param string $tpl_vars The variables to use in the view.
     * @return string The script output.
     */
    public function render( $tpl, $tplVars = array() )
    {
        return json_encode( array_merge( $this->_tpl_vars, $tplVars ) );
    }
}