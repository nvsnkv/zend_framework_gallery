<?php

class AlbumController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $id = $this->getRequest()->getParam('id');
        $album = Application_Model_AlbumMapper::load($id);

        $this->view->currentAlbum = $album;
    }

    public function createAction()
    {
        $form = new Application_Form_Album();
        $form->setAction('/album/create');

        $this->view->albumForm = $form;

        if ($this->getRequest()->isPost())
        {
            if ($form->isValid($_POST))
            {
                $data = $form->getValues();
                $album = new Application_Model_Album($data);
                $this->view->albumId = Application_Model_AlbumMapper::save($album);
                $this->getResponse()->setRedirect('/Album/'.$this->view->albumId.'/');
            }
        }
        else
        {
            $this->view->created = false;
        }
    }

    public function editAction()
    {
        $this->view->invalidData = false;

        $id = $this->getRequest()->getParam('id');
        $album = Application_Model_AlbumMapper::load($id);

        $form = new Application_Form_Album();
        $form->setAction("/Album/$id/Edit");

        if ($this->getRequest()->isPost())
        {

            if ($form->isValid($_POST))
            {
                $data = $form->getValues();
                $album = new Application_Model_Album($data);
                $this->view->albumId = Application_Model_AlbumMapper::save($album);
                $this->getResponse()->setRedirect('/Album/'.$album->id.'/');
            }
            else
            {
                $this->view->invalidData = true;
            }
        }

        $this->view->currentAlbum = $album;
        $this->view->albumForm = $form;
    }

    public function removeAction()
    {
        $id = $this->getRequest()->getParam('id');

        Application_Model_AlbumMapper::remove($id);
    }

    private function createAlbum($data)
    {
        $album = new Album($data);

        Application_Model_AlbumMapper::save($album);
    }


}







