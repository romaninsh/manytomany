<?php
class Model_GenericObject extends Model_Table {
    function init(){
        parent::init();

        $this->addField('object_id')->system(true);
        $this->o = $this->join('object');
        $this->o->addField('name');
        $this->o->addField('class')->defaultValue(get_class($this))->system(true);
    }
    function getChildren($type=null,$class){

        $m=$this->add($class);

        $c = $m->o->join('connection.child_id');
        $c->addField('parent_id');
        $c->addField('connection_type','type');

        $m->addCondition('parent_id',$this['object_id']);
        if($type)$m->addCondition('connection_type',$type);

        return $m;
    }
    function getAllChildren(){

        $m=$this->add('Model_Object');

        $c = $m->join('connection.child_id');
        $c->addField('parent_id');
        $c->addField('connection_type','type');

        $m->addCondition('parent_id',$this['object_id']);

        return $m;
    }
}
