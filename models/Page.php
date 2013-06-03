<?php

class Page
{
    protected $_root;
    
    protected $_path;

    public function __construct($root)
    {
        $this->_root = $root;
    }
    
    public function setPath($requestUri)
    {
        // Remove the GET string
        $requestUri = explode('?', $requestUri);
        $requestUri = $requestUri[0];

        // Check for bad uri's and potential hacks
        if (( strstr($requestUri, '//') !== false )
        or	( strstr($requestUri, '../') !== false )
        or	( strstr($requestUri, '/_') !== false )) {
            // Redirect those to _default
            $this->_path = '/_default.php';
            
        // Check if the file is an index
        } elseif (( substr($requestUri, -1) == '/' )
        and       ( file_exists($this->_root . 'views' . $requestUri . 'index.php') ))
        {
            $this->_path = $requestUri . 'index.php';
            
        // Check if the file exists
        } elseif (file_exists($this->_root . 'views' . rtrim($requestUri, '/') . '.php'))
        {
            $this->_path = rtrim($requestUri, '/') . '.php';
            
        // If none of the above 3 is applicable, find the nearest _default
        } else {
            $this->_path = $requestUri;
            do {
                // 
                $this->_path = substr($this->_path, 0, strrchr($this->_path, "/")-1);
                
                // Check if the default was located
                if (file_exists($this->_root . 'views' . $this->_path . '/_default.php')) {
                    $this->_path .= '_default.php';
                    break;
                }
            } while($this->_path != '');
        }
        // Varify that a path was found
        if ($this->_path == '') {
            trigger_error("Unable to process request $requestUri", E_USER_ERROR);
        }
        
        return $this->_path;
    }
    
    public function loadView()
    {
        ob_start();
        include $this->_root . 'views' . $this->_path;
        $content = ob_get_clean();
        
        header('Content-type: ' . $setup['filetype']);
        if (isset( $setup['header'] )) {
            include ROOT . 'views/' . $setup['header'];
        }
        echo $content;

        if (isset( $setup['footer'] )) {
            include ROOT . 'views/' . $setup['footer'];
        }

    }
    
    public function loadHelpers()
    {
        
    }
    
    public function loadController()
    {
        
    }
    
    public function hasController()
    {
        file_exists($this->_root . 'controllers' . $his->_path)
    }
    
    public function define()
    {
        
    }
    
    
}