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

  public function adminHead()
  {
    if (!$this->pageNeedsMe) {
      return '';
    }

    return $this->script($this->htmlPath().'js/tinymce.min.js');
  }

  public function adminBodyEnd()
  {
    if (!$this->pageNeedsMe) {
      return '';
    }

    return $this->snippet('invoke.htm');
  }
}