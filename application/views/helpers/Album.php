<?php
class Zend_View_Helper_Album extends Zend_View_Helper_Abstract
{
    public function album($album)
    {
        return '
		    <div class="albumPreview">
		        <div class="thumbnail pull-left">
		            <a href="/Album/'.$album->id.'"><img src="'.$album->thumbnail.'"></a>
		        </div>
		        <div class="description pull-left">
		            <a href="/Album/'.$album->id.'"><h2>'.$album->title.'</h2></a>
		            <p>'.$album->description.'</p>
		            <p> Pictures: '.$album->picturesCount.'</p>
		            <p>created: '.$album->created.'</p>
		            <p>last modified: '.$album->modified.'</p>
		            <a href="/Album/'.$album->id.'/Edit/">edit</a>
		            <a href="/Album/'.$album->id.'/Upload/">upload photo</a>
		            <a href="/Album/'.$album->id.'/Remove/">remove</a>
		        </div>
		        <div class="author pull-right">
		            <p>by '.$album->photographer->name.'</p>
		            <a href"mailto://'.$album->photographer->email.'">'.$album->photographer->email.'</a>
		            <p>'.$album->photographer->phone.'</p>
		        </div>
		        <div class="clearfix" />
		    </div>';
    }
}
?>