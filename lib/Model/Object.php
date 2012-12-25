<?php
class Model_Object extends Model_Table {
    public $table='object';
    function init(){
        parent::init();

        $this->addField('name');
        $this->addField('class');

        $this->addHook('beforeInsert,beforeDelete',function($m){
            throw $m->exception('Do not edit directly!');
        });
    }
    function getEntity(){
        return $this->add($this['class'])->loadBy('object_id',$this->id);
    }
}
