Lalalalala!

<?php

define('DS', '/');
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CONTENT_DIR', SITE_ROOT . DS . 'bl-content');
define('IMAGES_DIR', CONTENT_DIR . DS . 'uploads');

class imageBrowser {
  private $suffixes = ['jpg', 'jpeg', 'png'];        

  public function __construct() 
  {
    if (!is_dir(IMAGES_DIR)) {
      echo "No image folder!";
    }
    else {
      $relativeDir = $this->getCurrentDir();

      $images = $this->findImages($relativeDir);
    }
  }

  private function getCurrentDir()
  {
    return 'uploads';
  }

  private function isImageFile($name)
  {
    $info = pathinfo($name);

    return in_array($info['extension'], $this->suffixes);
  }

  private function makeUrl($relFile)
  {
    if (DS !== '/') {
      $relFile = str_replace(DS, '/', $relFile);
    }

    return '/bl-content/' . $relFile;
  }

  private function findImages($relativeDir) 
  {
    echo CONTENT_DIR . DS . $relativeDir . '<br/>';
    if (!is_dir(CONTENT_DIR . DS . $relativeDir)) {
      echo 'No image folder found';
      return null;
    }

    $dir = opendir(CONTENT_DIR . DS . $relativeDir);
    while (($file = readdir($dir)) !== false) {
      if ($this->isImageFile(CONTENT_DIR . DS . $relativeDir . DS . $file)) {
	$relFile = $relativeDir . DS . $file;
	$thumbFile = $relativeDir . DS . 'thumbnails' . DS . $file;

	if (is_file(CONTENT_DIR . DS . $thumbFile)) {
	  echo '<img class="tidymde-picker" src="' . $this->makeUrl($thumbFile) . '"></img>';
	}
      }
    }

    closedir($dir);

    echo file_get_contents(__DIR__ . DS . 'snippets/browser.htm');
  }  
}

$browser = new imageBrowser();
