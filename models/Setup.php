<?php

/*
    Setup::define(array(
            'PREPEND'        => false,
            'APPEND'         => false,
            'AUTHORIZE'      => array('admin', 'user'),
            'AUTHORIZE'      => 'admin',
            'PAGE_TITLE'     => 'Mijn webpagina',
            'SETUP_ONCE'     => false,
            'SETUP_OVERRIDE' => false
        ));
    
    Setup::redirect('/');
    Setup::redirect('/', 301);
    Setup::redirect('/', 'moved permanently');
    
    Setup::setAuth('John Smith', 'admin');
    if(Setup::hasAuth('admin')) {
        
    }
    
    Setup::setDefault(array(
            'PREPAND'        => '_header.php',
            'APPEND'         => '_footer.php',
            'STATUS'         => '200',
            'CONTENT_TYPE'   => 'html/text UTF-8',
            'SETUP_ONCE'     => true,
            'SETUP_OVERRIDE' => true,
            'LOGIN_PAGE'     => '/login'
        ));
?>
    <h1><?= PAGE_TITLE ?></h1>
*/

class Setup
{
    
    /**
     * Standard values for SimpleSite
     */
    static protected $_defaults = array(
            'PREPEND'        => '_header.php',
            'APPEND'         => '_footer.php',
            'CONTENT_TYPE'   => 'html/text UTF-8',
            'HTTP_STATUS'    => 200,
            'LOGIN_PAGE'     => '/login'
        );
        
    /**
     * 
     */
    static public function define($properties)
    {
        // define properties
        
        // authorize
        
        // process prepand
    }
    
    /**
     * 
     */
    static public function addDefaults($properties, $required)
    {
        // update defaults
    }
    
    /**
     * 
     */
    static public function redirect($url, $httpStatus = 302)
    {
        // redirect with a given http status code or name
        $httpCodes = array(
                300 => 'multiple choices',
                301 => 'moved permanently',
                302 => 'found',
                303 => 'see other',
                304 => 'not modified',
                307 => 'temporary redirect'
            );
    }
    
}