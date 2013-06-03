<?php

/**
 * Messenger stores messages to be pulled on a later request
 * 
 * Messenger is a good way to communicate to the user after
 * redirecting to another page.
 */
class Messenger
{
    /**
     * Start the session, if it's not yet started
     */
    public function __constructor()
    {
        if (!isset( $_SESSION )) {
            start_session();
        }
    }
    
    /**
     * Store a message in the session
     */
    public function storeMessage($message)
    {
        if (!isset( $_SESSION['simp:messages'] )) {
            $_SESSION['simp:messages'] = array();
        }
        
        $_SESSION['simp:messages'][] = $message;
    }
    
    /**
     * Take all the messages out of the messenger
     */
    public function pullMessages()
    {
        if (isset( $_SESSION['simp:messages'] )) {
            $messages = $_SESSION['simp:messages'];
            $_SESSION['simp:messages'] = array();
        } else {
            $messaegs = array();
        }
        
        return $messages;
    }
    
    /**
     * Get all the messages in messenger
     */
    public function getMessages()
    {
        return $_SESSION['simp:messages'];
    }
}