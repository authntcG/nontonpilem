<?php
namespace Application\Controller;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Application\Helper\HttpStatusCode;

class APICOntroller extends AbstractActionController {
    private $config;
    private $db;

    public function loadListAction() {
        try {
            $input = $this->getRequest()->getPost();
            $token = $input->token;

            $this->config = $this->getServiceLocator()->get('Config');
            $this->db = $this->config['db'];

            $film = new \Application\Model\Film($this->db);
            $data = $film->readData($token, null);

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
            $input = $this->getRequest()->getPost();
            $token = $input->token;
            $content = [
                "id_film"               => $input->id_film,
                "id_status_pembayaran"  => 1,
                "no_duduk"              => $input->no_duduk
            ];

            // $data = json_encode($data);
            // print_r($content);die;

            $this->config = $this->getServiceLocator()->get('Config');
            $this->db = $this->config['db'];

            // Submit Data
            $order = new \Application\Model\Order($this->db);
            $data = $order->submitData($token, $content);

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

    public function updateOrderAction() {
        try {
            $input = $this->getRequest()->getPost();
            $token = $input->token;
            $content = [
                "id_status_pembayaran"  => 2,
            ];

            // $data = json_encode($data);
            // print_r($content);die;

            $this->config = $this->getServiceLocator()->get('Config');
            $this->db = $this->config['db'];

            // Submit Data
            $order = new \Application\Model\Order($this->db);
            $data = $order->updateData($token, $content, $input->id_order);

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

    // Order Sections
    public function loadOrderAction() {
        try {
            $input = $this->getRequest()->getPost();
            $token = $input->token;

            $this->config = $this->getServiceLocator()->get('Config');
            $this->db = $this->config['db'];

            $order = new \Application\Model\Order($this->db);
            $data = $order->readData($token);

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

}

?>