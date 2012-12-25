<?php
class Model_Person extends Model_GenericObject {
    public $table='person';
    function init(){
        parent::init();
        $this->addField('email');
    }
}
