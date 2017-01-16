<?php

require_once('pluginplus.php');

class pluginTidyMCE extends PluginPlus
{
  // Controllers that use this plugin. For any other controller, we
  // do nothing
  public $usedBy = ['new-post',
		    'new-page',
		    'edit-post',
		    'edit-page'];

  public function siteHead() {
    $html = $this->css($this->htmlPath() . 'js/lightbox/css/lightbox.css') .
            $this->script($this->htmlPath() . 'js/jquery.min.js');
            $this->script($this->htmlPath() . 'js/lightbox/js/lightbox.js');

    return $html;
  }

  public function adminHead()
  {
    if (!$this->pageNeedsMe) {
      return '';
    }

    $html = $this->css($this->htmlPath() . 'js/lightbox/css/lightbox.css') .
            $this->script($this->htmlPath() . 'js/tinymce.min.js') .
            $this->script($this->htmlPath() . 'js/lightbox/js/lightbox.js');

    return $html;
  }

  public function adminBodyEnd()
  {
    if (!$this->pageNeedsMe) {
      return '';
    }

    return $this->script($this->htmlPath() . 'js/tidymce.js');
  }
}