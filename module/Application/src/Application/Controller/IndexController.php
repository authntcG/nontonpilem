<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $movies = [
            ['title' => 'Film A', 'price' => '35000', 'play_time' => '18:30 WIB', 'image' => '#'],
            ['title' => 'Film B', 'price' => '25000', 'play_time' => '20:00 WIB', 'image' => '#'],
            ['title' => 'Film C', 'price' => '20000', 'play_time' => '20:00 WIB', 'image' => '#'],
            ['title' => 'Film D', 'price' => '22000', 'play_time' => '20:00 WIB', 'image' => '#'],
            ['title' => 'Film E', 'price' => '23000', 'play_time' => '20:00 WIB', 'image' => '#'],
            ['title' => 'Film F', 'price' => '27000', 'play_time' => '20:00 WIB', 'image' => '#'],
        ];

        return new ViewModel(['movies' => $movies]);
    }
}
