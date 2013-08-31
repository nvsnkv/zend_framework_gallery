<?php
class Zend_View_Helper_Album extends Zend_View_Helper_Abstract
{
    public function album($album)
    {
        return '
		    <div class="albumPreview">
		        <div class="thumbnail pull-left">
		            <a href="/album/'.$album->id.'"><img src="'.$album->thumbnail.'"></a>
		        </div>
		        <div class="description pull-left">
		            <a href="/album/'.$album->id.'"><h2>'.$album->title.'</h2></a>
		            <p>'.$album->description.'</p>
		            <p> Pictures: '.$album->picturesCount.'</p>
		            <p>created: '.$album->created.'</p>
		            <p>last modified: '.$album->modified.'</p>
		            <a href="/album/'.$album->id.'/edit/">edit</a>
		            <a href="/album/'.$album->id.'/upload/">upload photo</a>
		            <a href="/album/'.$album->id.'/remove/">remove</a>
		        </div>
		        <div class="author pull-right">
		            <p>by '.$album->photographer->name.'</p>
		            <a href"mailto:'.$album->photographer->email.'">Send message</a>
		            <p>'.$album->photographer->phone.'</p>
		        </div>
		        <div class="clearfix" />
		    </div>';
    }
}
?>