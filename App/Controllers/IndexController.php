<?php
/**
 * Index controller - default controller
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Controllers;

class IndexController extends \App\Core\Controller
{

    public function indexAction()
    {
        return [
            'title'=>'Demo FAAX micro framework',
            'dat'=>date('d.m.Y'),
        ];
    }
}