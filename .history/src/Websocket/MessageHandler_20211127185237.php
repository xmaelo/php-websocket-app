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
    protected TableRepository $tableR; 
    protected OrderStateRepository $orderR; 
    protected ConsommableRepository $consomR; 

    protected $connections;

    public function __construct()
    {
        $this->connections = new SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->connections->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach($this->connections as $connection)
        {
            if($connection === $from)
            {
                continue;
            }
            $state = true;
            // $data = json_decode($data);
            // $com = new Commande();
            // $com->quantity = $data['quantity'];
            // $com->date = $data['date'];

            // $tab = $this->tableR->findBy(['id'=>intval($data['id'])]);
            // $com->table_ = $tab[0];

            // $tab = $this->orderR->findBy(['id'=>intval($data['id'])]);
            // $com->status = $tab[0];

            // $arr = array();
            // for ($i=0; $i < $data['consommabes']; $i++) { 
            //     $consommable = $data['consommabes'][$i];

            //     $tab = $this->consomR->findBy(['id'=>intval($consommable)]);
                
            //     array_push($arr, $tab[0]);
            // }

            // $com->consommabes = $arr;

            // $this->manager->persist($com);
            // $this->manager->flush();

            if($state == true){
               $connection->send($msg);
            }
        }
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
}