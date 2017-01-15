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
    $pwd = $_GET['folder'];

    if (!$pwd) {
      $pwd = 'uploads';
    }

    return $pwd;
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

  private function showFolder($pfx, $relativeName)
  {
    $dir = basename($relativeName);
    $image = 'open_folder.png';

    if ($dir === '..') {
      $crumbs = explode('/', $relativeName);

      if (count($crumbs) <= 2) {
	return;
      }

      $image = 'parent_folder.png';
    }
    else if ((substr($dir, 0, 1) == '.') or ($dir == 'thumbnails')) {
      return;
    }

?>
    <div class="tidy-inline" data-folder="<?= $relativeName ?>">
      <img class="tidymde-folder" src="/bl-plugins/tidyMCE/images/<?= $image ?>"></img>
      <br/><?= $dir ?>
    </div>
<?php
  }

  private function showImage($pfx, $relativeName)
  {
    $file = $pfx . $relativeName;
    if (is_file($file)) {
?>
      <div class="tidy-inline">
        <img class="tidymde-picker" src="<?php echo $this->makeUrl($relativeName) ?>" width="128" height="128"></img>
	<br/><?= basename($relativeName) ?>
      </div>
<?php
    }
  }

  private function findImages($relativeDir) 
  {
    $folders = [];
    $images = [];

    if (!is_dir(CONTENT_DIR . DS . $relativeDir)) {
      echo 'No image folder found';
      return null;
    }

    $pfx = CONTENT_DIR . DS;

    $dir = opendir($pfx . $relativeDir);
    while (($file = readdir($dir)) !== false) {
      $relFile = $relativeDir . DS . $file;
      $fullName = $pfx . $relativeDir . DS . $file;

      if (is_dir($fullName)) {
	$folders[] = $relFile;
      }
      else if ($this->isImageFile($fullName)) {
	$thumbFile = $relativeDir . DS . 'thumbnails' . DS . $file;
	if (!is_file($pfx . $thumbFile)) {
	  $thumbFile = $relFile;
	}

	$images[] = $thumbFile;
      }
    }

    closedir($dir);

    sort($folders);
    foreach ($folders as $folder) {
      $this->showFolder($pfx, $folder);
    }

    sort($images);
    foreach ($images as $image) {
      $this->showImage($pfx, $image);
    }
  }  
}

new ImageBrowser();
