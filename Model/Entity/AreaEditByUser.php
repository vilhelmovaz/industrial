<?php

class AreaEditByUser {

    /** @var int */
    protected $editableAreaId;

    /** @var int */
    protected $userId;

    /** @var boolean */
    protected $allowed;

    /** @var boolean */
    protected $editing;

    /** @var string */
    protected $timeOfStart;

    public function getEditableAreaId() {
        return $this->editableAreaId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getAllowed() {
        return $this->allowed;
    }

    public function getEditing() {
        return $this->editing;
    }

    public function getTimeOfStart() {
        return $this->timeOfStart;
    }

    public function setAllowed($allowed) {
        $this->allowed = $allowed;
    }

    public function setEditing($editing) {
        $this->editing = $editing;
    }

    public function setTimeOfStart($timeOfStart) {
        $this->timeOfStart = $timeOfStart;
    }

}
