<?php
namespace Application\Controller;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Application\Helper\HttpStatusCode;

class APICOntroller extends AbstractActionController {
    private $config;
    private $db;
    
    public function serverInfoAction() {
        // Mendapatkan objek response
        $response = $this->getResponse();
        
        // Mendapatkan status code dari response
        $statusCode = $response->getStatusCode();
        
        // Mendapatkan pesan berdasarkan status code
        $statusMessage = HttpStatusCode::getStatusMessage($statusCode);

        // Membuat data JSON dari objek response
        $data = [
            "code" => $statusCode,
            "info" => $statusMessage
        ];

        // Mengembalikan data sebagai response JSON
        $response->setContent(json_encode($data));
        return $response;
    }

    public function loadListAction() {
        try {
            $input = $this->getRequest()->getPost();
            $token = $input->token;

            $this->config = $this->getServiceLocator()->get('Config');
            $this->db = $this->config['db'];

            $film = new \Application\Model\Film($this->db);
            $data = $film->readData($token);

            $response = $this->getResponse();
            $response->setContent(json_encode($data));
        } catch (\Exception $e) {
            $decode = [
                "code" => "2",
                "info" => "Error: ".$e,
                "data" => null
            ];

            $response = $this->getResponse();
            $response->setContent(json_encode($decode));
        }

        return $response;
    }

    public function createOrderAction() {
        try {
            //code...
        } catch (\Exception $e) {
            //throw $th;
        }
    }

}

?>