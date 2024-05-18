<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Di\Di;

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
            $gateway = new TableGateway('vorder', $this->adapter);
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
        // print_r($input['id_film']);die;
        $film = ($this->checkFilmAvailable($input['id_film']));
        if (self::token !== $token) {
            $data = [
                "code" => "1",
                "info" => "Error:Unauthorized",
                "data" => null
            ];
        } else if (empty($film)) {
            $data = [
                "code" => "3",
                "info" => "Error:Data Invalid",
                "data" => null
            ];
        } else {
            $gateway = new TableGateway('order', $this->adapter);
            $result = $gateway->insert($input);

            if ($result == 1) {                
                $stmt = $this->adapter->createStatement(
                    'SELECT DISTINCT(LAST_INSERT_ID()) AS id_order FROM `order`'
                );
        
                $result = $stmt->execute();
        
                if ($result instanceof ResultInterface && $result->isQueryResult()) {
                    $resultSet = new ResultSet();
                    $resultSet->initialize($result);
        
                    $res = $resultSet->toArray();
                    // print_r($film[0]['nama_film']);die;

                    $res = [
                        "id_order" => $res[0]['id_order'],
                        "nama_film" => $film[0]['nama_film']
                    ];
                }
            }

            $data = [
                "code" => "0",
                "info" => "OK",
                "data" => $res
            ];
        }
        return $data;
    }

    public function updateData($token, $input, $id)
    {
        if (self::token !== $token) {
            $data = [
                "code" => "1",
                "info" => "Error:Unauthorized",
                "data" => null
            ];
        } else {
            $gateway = new TableGateway('order', $this->adapter);
            $result = $gateway->update($input, ['id_order' => $id]);

            if ($result == 1) {
                $stmt = $this->adapter->createStatement(
                    'SELECT * FROM vorder WHERE id_order = '.$id
                );
        
                $result = $stmt->execute();
                
        
                if ($result instanceof ResultInterface && $result->isQueryResult()) {
                    $resultSet = new ResultSet();
                    $resultSet->initialize($result);
        
                    $res = $resultSet->toArray();
                    // print_r($film[0]['nama_film']);die;

                    $res = [
                        "id_order" => $res[0]['id_order'],
                        "status_pembayaran" => $res[0]['deskripsi']
                    ];
                }
            }

            $data = [
                "code" => "0",
                "info" => "OK",
                "data" => $res
            ];
        }
        return $data;
    }

    public function checkFilmAvailable($input)
    {
        $stmt = $this->adapter->createStatement('SELECT nama_film FROM film WHERE id_film = '.$input);

        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet();
            $resultSet->initialize($result);
            $res = $resultSet->toArray();
            return $res;
        }
    }
    
}

?>