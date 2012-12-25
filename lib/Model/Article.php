<?php
class Model_Article extends Model_GenericObject {
    public $table='article';
    function init(){
        parent::init();

        $this->addField('body')->type('text');

        $this->getElement('name')->caption('Title');
    }
}
