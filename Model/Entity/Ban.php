<?php

class Ban {

    /** @var int */
    protected $idBan;

    /** @var int */
    protected $userId;

    /** @var string */
    protected $from;

    /** @var string */
    protected $to;

    public function getIdBan() {
        return $this->idBan;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getTo() {
        return $this->to;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function setTo($to) {
        $this->to = $to;
    }

}
