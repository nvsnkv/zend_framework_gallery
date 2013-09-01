<?php

class Application_Form_Picture extends Zend_Form
{

    public function init()
    {
        $this->setMethod('POST');

        $albumId = $this->createElement('select', 'album_id');
        $albumId->setLabel('Album: ')
                ->setRequired(true)
                ->setRegisterInArrayValidator(false);

        $this->addElement($albumId);

        $title = $this->createElement('text','title');
        $title->setRequired(true)
              ->setLabel('Title: ')
              ->addValidator('StringLength', false, array(1,50));

        $this->addElement($title);

        $file = $this->createElement('file','upload');
        $file->setRequired(true)
             ->addValidator('NotEmpty')
             ->addValidator('Count', false, 1)
             ->addValidator('Size', false, Application_Model_Picture::MAX_FILE_SIZE)
             ->setMaxFileSize(Application_Model_Picture::MAX_FILE_SIZE)
             ->setDestination(Application_Model_Picture::CONTENT_DIR);

        $this->addElement($file);

        $description = $this->createElement('textarea', 'location');
        $description->setRequired(false)
                    ->setLabel('Location: ')
                    ->addValidator('StringLength', false, array(1,200));

        $this->addElement($description);

        $submit = $this->createElement('submit', 'submit');
        $submit->setLabel('Upload');

        $this->addElement($submit);
    }

    public function addAlbums($albums)
    {
        $albumId = $this->getElement('album_id');
        $options = array();

        foreach($albums as $album)
            $options[$album->id] = $album->title;

        $albumId->addMultiOptions($options);
    }


}

