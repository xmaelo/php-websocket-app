<?php
namespace App\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class MessageHandler implements MessageComponentInterface
{

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
            $state = $this->postData($msg);
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

    public function postData($data){
        $postdata = http_build_query(
            array(
                'name' => 'Robert',
                'id' => '1'
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents('http://localhost/request.php', false, $context);
        return true
    }
}