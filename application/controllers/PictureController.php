<?php

class PictureController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $picture = Application_Model_PictureMapper::load($this->getRequest()->getParam('hash'));
        $this->view->picture = $picture;
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

                $picture->album->thumbnail = $picture->thumbnail;
                $picture->album->modified = new Zend_Date();

                Application_Model_AlbumMapper::save($picture->album);

                $this->getResponse()->setRedirect('/Picture/'.$picture->hash.'/');
            }
        }

        $id = $this->getRequest()->getQuery('albumId');
        if ($id)
        {
            $albums = array();
            $albums[] = Application_Model_AlbumMapper::load($id);
        }
        else
        {
            $albums = Application_Model_AlbumMapper::loadAll();
        }
        $this->view->albums = $albums;

        $this->view->form = $form;
    }

    public function removeAction()
    {
        $picture = Application_Model_PictureMapper::load($this->getRequest()->getParam('hash'));
        $picture->removeFiles();
        Application_Model_PictureMapper::remove($picture->hash);

        $this->getResponse()->setRedirect("/Album/".$picture->album->id);
    }


}





