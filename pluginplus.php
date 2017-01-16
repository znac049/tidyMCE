<?php

class PluginPlus extends Plugin
{
  // Controllers that use this plugin. For any other controller, we
  // do nothing
  public $usedBy = false;

  protected $pageNeedsMe;
  protected $controllerName;

  public function __construct()
  {
    global $layout;

    parent::__construct();

    $this->controllerName = $layout['controller'];
    
    $this->pageNeedsMe = true;
    if (is_array($this->usedBy)) {
      $this->pageNeedsMe = in_array($this->controllerName, $this->usedBy);
    }
    else {
      $this->pageNeedsMe = $this->usedBy;
    }
  }

  protected function translate($key)
  {
    global $Language;

    return $Language->get($key);
  }

  protected function tag($tagType, $content='', $opt=[], $needsEnd=true)
  {
    $html = '<' . $tagType;

    foreach ($opt as $name => $val) {
      $html .= ' ' . $name . '="' . $val . '"';
    }

    $html .= '>';

    if ($needsEnd) {
      $html .= '</' . $tagType . '>';
    }

    return $html;
  }

  protected function script($name)
{
    return $this->tag('script', '', ['src' => $name]);
  }

  protected function css($name)
  {
    return $this->tag('link', '', ['rel' => 'stylesheet', 'type' => 'text/css', 'href' => $name], false);
  }

  protected function jqElement($idOrClass)
  {
    $js = '$(' . "'" . $idOrClass . "'" . ')';

    return $js;
  }
}