<?php
class Model_Comment extends Model_Article {
    public $table='comment';
    function init(){
        parent::init();

        $this->getElement('name')->hidden(true);
    }
}
