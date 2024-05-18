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

class RiwayatController extends AbstractActionController
{
    public function indexAction()
    {
        // Ambil data transaksi dari database atau sumber lainnya
        $transactions = [
            ['id' => 1, 'film' => 'Film A', 'price' => 50000, 'status' => 'Belum Selesai', 'time' => '12:00'],
            ['id' => 2, 'film' => 'Film B', 'price' => 60000, 'status' => 'Selesai', 'time' => '14:00'],
            // tambahkan data transaksi lainnya
        ];

        return new ViewModel([
            'transactions' => $transactions,
        ]);
    }
}
