<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Film {
    private $adapter;
    const token = "asdb212";

    public function __construct($config)
    {
        $this->adapter = new Adapter($config);   
    }

    public function readData($token)
    {   
        if (self::token !== $token) {
            $data = [
                "code" => "1",
                "info" => "Error:Unauthorized",
                "data" => null
            ];
        } else {
            $gateway = new TableGateway('film', $this->adapter);
            $rowset = $gateway->select();

            $resultSet = new ResultSet;
            $resultSet->initialize($rowset);
            $res = $resultSet->toArray();
            $data = [
                "code" => "0",
                "info" => "OK",
                "data" => $res
            ];
        }
        
        return $data;
    }

    public function saveData($data)
    {
        $gateway = new TableGateway('film', $this->adapter);
        $result = $gateway->insert($data);
        return $result;
    }
}

?>