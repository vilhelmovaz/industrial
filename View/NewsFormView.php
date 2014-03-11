<?php

include_once 'View.php';

class NewsFormView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printTitle() {
        if ($this->model->add) {
            echo("Add News");
        } else {
            echo("Edit News");
        }
    }

    public function printBody() {
        global $loggedIn;
        global $admin;
        if ($loggedIn && $admin) {
            if($this->model->add){
                ?>
                <form name='addNews' method='post' action='./index.php?page=newsEdit'>
                    <input type='hidden' name='action' value='addNews' />
                    <input id='title' type='text' placeholder="Title" name='title' autofocus />
                    <textarea class='addForm' id='message' cols='30' rows='6' name='message'></textarea>
                    <input class='save' type='submit' name='save' value='Save' />
                </form>
            <?php
            }
            if($this->model->edit){
                $message = $this->model->news->getMessage();
                $title = $this->model->news->getTitle();
                $id = $this->model->news->getIdEditableArea();
                ?>
                <form name='editNews' method='post' action='./index.php?page=newsEdit'>
                    <input type='hidden' name='action' value='editNews' />
                    <input type='hidden' name='id' value='<?php echo $id; ?>' />
                    <input id='title' type='text' placeholder="Title" name='title' value="<?php echo $title; ?>" />
                    <textarea class='editForm' id='message' cols='30' rows='6' name='message' autofocus><?php echo $message; ?> </textarea>
                    <input class='save' type='submit' name='save' value='Save' />
                </form>
            <?php
            }
        }
    }

    public function printPageHeader() {
        if ($this->model->add) {
            echo("Add News");
        } else {
            echo("Edit News");
        }
    }

}