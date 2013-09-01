<?php
class Zend_View_Helper_Picture extends Zend_View_Helper_Abstract
{
    public function picture($picture)
    {
        return '
		    <div class="picture">
		        <h2>'.$picture->title.'</h2>
		        <img src="'.$picture->url.'" />
		        <p> location: </p>
		        <p> '.$picture->location.' </p>
		    </div>';
    }
}
?>