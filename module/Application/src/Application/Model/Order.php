<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Order {
    private $adapter;
    const token = "hfjdu36498";

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
            $gateway = new TableGateway('order', $this->adapter);
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

    public function submitData($token, $input)
    {   
        if (self::token !== $token) {
            $data = [
                "code" => "1",
                "info" => "Error:Unauthorized",
                "data" => null
            ];
        } else {
            $gateway = new TableGateway('order', $this->adapter);
            $result = $gateway->insert($input);

            $data = [
                "code" => "0",
                "info" => "OK",
                "data" => $result
            ];
        }
        return $data;
    }
    
}

?>