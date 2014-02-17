<?php

include_once 'View.php';

class ItemView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {
        
    }

    public function printBody() {
        global $loggedin;
        global $admin;
        $itemId = $this->model->item->getIdItem();

        $details = $this->model->item->getDetails();
        foreach ($this->model->editArea as $area) {
            $title = $area->getTitle();

            echo("<div class='itemTextArea'>");
            $this->printSubsectionHeader($title);
            $text = $area->getText();
            $date = $area->getDate();
            $this->printTextArea($text, $date);
            $id = $area->getIdEditableArea();
            if ($loggedin && $admin) {


                echo<<<_END
            <div class='buttonsItemEditArea'>
                <form  name='editItem' method='post' action='./index.php?page=edit&item=$itemId'>
                <input type='hidden' name='action' value='edit'/>
                <input type='hidden' name='areaId' value='$id'/>
                <input type='submit' name='edit' value='Edit'/>
                </form>

                <form  name='deleteItemEdit' method='post' action='./index.php?page=item&item=$itemId'>
                <input type='hidden' name='action' value='delete'/>
                <input type='hidden' name='areaId' value='$id'/>
                <input type='submit' name='delete' value='Delete'/>
                </form>
            </div>
_END;
            }
            echo("</div>");
            echo ($this->model->msg);
        }
    }

    public function printPageHeader() {
        $name = $this->model->item->getName();
        if ($name != '') {
            echo($name);
        } else {
            echo("Add Item");
        }
    }

    public function printTextArea($text, $date) {
        echo ($text . "</br>" . $date);
    }

    public function printSubsectionHeader($name) {
        echo("<h2>");
        echo($name);
        echo("</h2>");
    }

    public function printTitle() {
        $name = $this->model->item->getName();
        if ($name != '') {
            echo($name);
        } else {
            echo("Add Item");
        }
    }

}
