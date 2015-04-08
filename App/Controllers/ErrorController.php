<?php
/**
 * Error controller
 * Show cached errors
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Controllers;

class ErrorController extends \App\Core\Controller
{

    public function indexAction()
    {
        return [
            'title'=>'Demo FAAX micro framework. Error page.',
        ];
    }
}