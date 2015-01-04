<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class FlashMessages
 *
 * CodeIgniter ready flash messages library
 *
 *  The MIT License (MIT)
 *
 *  Copyright (c) <year> <copyright holders>
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 *
 *
 * @author Jair Milanes Junior
 * @version 1.0
 */
class FlashMessages {

    /**
     * @var $ci
     */
    protected $ci;

    const FLASH_SUCCESS = 'success';
    const FLASH_ERROR   = 'danger';
    const FLASH_WARNING = 'warning';
    const FLASH_INFO    = 'info';

    /**
     * FlashMessages constructor
     */
    public function __construct(){
        $this->ci =& get_instance();
    }

    /**
     * Add a success flash message
     *
     * @param string $message
     * @return bool
     */
    public function add_ok($message = ''){
        $this->add_message($message,self::FLASH_SUCCESS);
        return true;
    }

    /**
     * Adds a error flash message
     *
     * @param string $message
     * @return bool
     */
    public function add_error($message = ''){
        $this->add_message($message,self::FLASH_ERROR);
        return true;
    }

    /**
     * Adds a warning flash message
     *
     * @param string $message
     * @return bool
     */
    public function add_warning($message = ''){
        $this->add_message($message, self::FLASH_WARNING);
        return true;
    }

    /**
     * Adds a info flash message
     *
     * @param string $message
     * @return bool
     */
    public function add_info($message = ''){
        $this->add_message($message,self::FLASH_INFO);
        return true;
    }

    /**
     * Get all flash messages or by type
     *
     * @param string $type
     */
    public function get($type = '' ){
        if( !empty($type)){
            return $this->ci->session->flashdata($type);
        }
    }

    /**
     * Returns all messages in array format
     *
     * @return array
     */
    public function get_all(){
        $types = array(
            self::FLASH_SUCCESS,
            self::FLASH_ERROR,
            self::FLASH_WARNING,
            self::FLASH_INFO
        );
        $messages = array();
        foreach($types as $type){
            $messages[$type] = $this->get($type);
        }
        return array_filter($messages);
    }

    /**
     * Protected add message method
     *
     * @param string $message
     * @param string $type
     * @return bool
     */
    protected function add_message($message = '', $type = 'default'){
        $this->ci->session->set_flashdata($type, $message);
        return true;
    }
}