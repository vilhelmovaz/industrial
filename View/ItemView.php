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
        echo<<<_END
                <form  name='editItem' method='post' action='./index.php?page=edit&item=$itemId'>
                <input type='hidden' name='action' value='editItem'/>
                <input type='submit' name='editItem' value='Edit Item'/>
                </form>
_END;
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
                <input type='hidden' name='action' value='editArea'/>
                <input type='hidden' name='areaId' value='$id'/>
                <input type='submit' name='editArea' value='Edit'/>
                </form>

                <form  name='deleteItemEdit' method='post' action='./index.php?page=item&item=$itemId'>
                <input type='hidden' name='action' value='delete'/>
                <input type='hidden' name='areaId' value='$id'/>
                <input type='submit' name='delete' value='Delete'/>
                </form>
                        
                <form  name='changeWeight' method='post' action='./index.php?page=item&item=$itemId'>
                <input type='hidden' name='action' value='moveUp'/>
                <input type='hidden' name='areaId' value='$id'/>
                <input class='imageButton' type='image' name='up' src='pictures/up.jpg' alt='move up'/>
                </form>
                        
                <form  name='changeWeight' method='post' action='./index.php?page=item&item=$itemId'>
                <input type='hidden' name='action' value='moveDown'/>
                <input type='hidden' name='areaId' value='$id'/>
                <input class='imageButton' type='image' name='down' src='pictures/down.jpg' alt='move down'/>
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
