<?php
namespace App\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Repository\TableRepository;
use App\Repository\OrderStateRepository;
use App\Repository\ConsommableRepository;

class MessageHandler implements MessageComponentInterface
{
    protected $tableR = null; 
    protected $orderR = null; 
    protected $consomR = null; 

    protected $connections;

    public function __construct(TableRepository $t, OrderStateRepository $o, ConsommableRepository $c)
    {
        $this->connections = new SplObjectStorage;
        $this->tableR = $t;
        $this->orderR = $o;
        $this->consomR = $c;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->connections->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->connections->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        $this->connections->detach($conn);
        $conn->close();
    }

    // public function postData($data){
    //     $postdata = http_build_query(json_decode($data));
    //     $opts = array('http' =>
    //         array(
    //             'method' => 'POST',
    //             'header' => 'Content-type: application/json',
    //             'content' => $postdata
    //         )
    //     );
    //     $context = stream_context_create($opts);
    //     $result = file_get_contents('http://localhost:8000/api/commandes', false, $context);
    //     //print()
    //     return $result;
    // }
}