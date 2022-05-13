<?php

namespace App\Interfaces;

interface PennyLaneServiceInterface {

    public function connect();
    public function disconnect();
    public function create();
    public function exist();
    public function delete();
    public function subscription();
    public function unsubscription();
    public function billing();

}

?>