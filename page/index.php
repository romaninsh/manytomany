<?php
class page_index extends Page {
    function initMainPage(){

        $tabs=$this->add('Tabs');
        

        // Add Persons
        $t=$tabs->addTab('Person');
        $c=$t->add('CRUD');
        $c->setModel('Person');
        if($c->grid){
            $c->grid->addColumn('expander','all');
        }

        $t=$tabs->addTab('Articles');
        $c=$t->add('CRUD');
        $c->setModel('Article');
        if($c->grid){
            $c->grid->addColumn('expander','comments');
        }

        $tabs->addTab('Comment')->add('CRUD')->setModel('Comment');
        $tabs->addTab('Object')->add('CRUD')->setModel('Object');
        $tabs->addTab('Connection')->add('CRUD')->setModel('Connection');
    }
    function page_comments(){
        $this->api->stickyGET('article_id');

        $a=$this->add('Model_Article')->load($_GET['article_id']);

        //$m = $a->ref('Comment');

        $m=$a->getChildren('has comment','Model_Comment');

        $this->add('CRUD')->setModel($m);
    }
    function page_all(){
        $this->api->stickyGET('person_id');

        $a=$this->add('Model_Person')->load($_GET['person_id']);

        $m=$a->getAllChildren();

        $c=$this->add('CRUD');
        $c->setModel($m);
        if($c->grid){
            $c->grid->addColumn('button','edit_object','Edit Object');
            if($_GET['edit_object']){
                $this->js()->univ()->dialogURL('Editing',$this->api->url('./editobject',
                    array('object_id'=>$_GET['edit_object'])
                ))->execute();
            }
            $c->grid->addButton('New Friend')->js('click')->univ()->dialogURL('Add a new friend',
                $this->api->url('./add',array('model'=>'Model_Person','type'=>'friend'))
            );
            $c->grid->addButton('New Article')->js('click')->univ()->dialogURL('Add a new friend',
                $this->api->url('./add',array('model'=>'Model_Article','type'=>'wrote'))
            );
        }
    }
    function page_all_editobject(){
        $m=$this->add('Model_Object')->load($_GET['object_id']);

        $e = $m->getEntity();

        $this->add('Form')->setModel($e);
    }
    function page_all_add(){
        $this->api->stickyGET('person_id');
        $this->api->stickyGET('model');
        $this->api->stickyGET('type');
        $a=$this->add('Model_Person')->load($_GET['person_id']);

        $m=$a->getChildren($_GET['type'],$_GET['model']);


        $f=$this->add('Form');
        $f->setModel($m);
        if($f->isSubmitted()){
            $f->update()->js()->univ()->successMessage('Cool!')->execute();
        }
    }
}
