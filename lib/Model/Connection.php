<?php
class Model_Connection extends Model_Table {
    public $table='connection';
    function init(){
        parent::init();

        $this->hasOne('Object','parent_id');
        $this->addField('type');
        $this->hasOne('Object','child_id');

    }
}
