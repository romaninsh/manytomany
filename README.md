SQL ORM = Inheritance + Generic Relations on Agile Toolkit
==========

One of the fundamental problem solved by Agile Toolkit is mapping the
PHP inheritance into SQL layer. The PHP model may extend your objects by
adding additional tables into the mix. That's a standard SQL pattern:
http://martinfowler.com/eaaCatalog/singleTableInheritance.html

Further from here, you might wonder how to maintain connections between
the primary table records. 

![Screenshot](https://raw.github.com/romaninsh/manytomany/master/screenshot.png)

Any to Any relation
------
In this project, the Aglie Toolkit ORM (http://agiletoolkit.org/) is
used to build any to any relation. This permits any object of your
database to be connected to any other object as you see on the diagram.
However by extending the ORM models, we can create a nice syntactic
sugar you can use throughout your application:

![Demo Screenshot](https://raw.github.com/romaninsh/manytomany/master/screenshot2.png)


Code Example 1


        // Get all comments for an article
        $a=$this->add('Model_Article')->load($_GET['article_id']);
        $m=$a->getChildren('has comment','Model_Comment');

        // And allow to edit them in a CRUD
        $this->add('CRUD')->setModel($m);

Code Example 2

        // Generic page allowing to add any child to any object

        $a=$this->add('Model_Person')->load($_GET['person_id']);
        $m=$a->getChildren($_GET['type'],$_GET['model']);

        $f=$this->add('Form');
        $f->setModel($m);
        if($f->isSubmitted()){
            $f->update()->js()->univ()->successMessage('Cool!')->execute();
        }

More Examples: https://github.com/romaninsh/manytomany/blob/master/page/index.php

The above implementation maintains the integrity of the database
entirely. Although the code to implement this structure using Agile
Toolkit is not long, I provide the 1-hour YouTube video tutorial on how
to put all of this from scratch:

https://www.youtube.com/watch?v=8oysmRUzs54


