<?php

class PictureController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function uploadAction()
    {
        $form = new Application_Form_Picture();

        if ($this->getRequest()->isPost())
        {

            if ($form->isValid($_POST))
            {
                $data = $form->getValues();
                $fileInfo = Application_Model_Picture::prepareFile($data);

                $picture = new Application_Model_Picture(array_merge($fileInfo, $data));
                Application_Model_PictureMapper::save($picture);
            }
        }

        $this->view->albums = Application_Model_AlbumMapper::loadAll();

        $this->view->form = $form;
    }


}



