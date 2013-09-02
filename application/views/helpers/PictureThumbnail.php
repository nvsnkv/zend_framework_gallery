<?php
class Zend_View_Helper_PictureThumbnail extends Zend_View_Helper_Abstract
{
    public function pictureThumbnail($picture)
    {
        return '
		    <div class="thumbnail pull-left">
		        <a href="/Picture/'.$picture->hash.'/">
		            <img src="'.$picture->thumbnail.'" />
		        <?a>
		    </div>';
    }
}
?>