<?php

namespace App\Interfaces;

interface PennyLaneServiceInterface {

    public function connect();
    public function create();
    public function delete();
    public function exist();
    public function disconnect();
    public function subscription();
    public function unsubscription();
    public function billing();

}

?>