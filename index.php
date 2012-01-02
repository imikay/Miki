<?php
error_reporting(E_ALL);

$uri = $_SERVER['REQUEST_URI'];
$pathInfo = array_filter(explode('/', $uri));


$articles = array_filter(array_filter(scandir('articles/')), 
                        function ($v){ 
                          $name = explode('.', $v);
                          $ext = count($name) == 2 ? $name[1] : '';
                          
                          return $v != '.' && $v != '..' && $ext == 'txt' && !is_dir('articles/'.$v);
                        });

if (count($pathInfo) == 4)
{
  $article = file_get_contents('articles/'.implode('-', $pathInfo).'.txt');
  $articleInfo = preg_split('/\n\n/', $article, null, PREG_SPLIT_NO_EMPTY);
  $meta = $articleInfo[0];
  $metaArr = preg_split('/\n/', $meta, null, PREG_SPLIT_NO_EMPTY); 

  $metaData = array();
  
  foreach ($metaArr as $metaInfo)
  {
    $info = explode(':', $metaInfo);
    
    $metaData[trim($info[0])] = trim($info[1]);
  }

  $content = trim(implode(array_map(function ($paragraph){ return '<p>'.$paragraph.'</p>'; }, array_slice($articleInfo, 1))));    
}
?>

<DOCTYPE html>
<html>
  <head>
    <link href="/css/main.css" type="text/css" rel="stylesheet">      
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <title>
      <?php echo $metaData['title']; ?>
    </title>
  </head>
  <body>
    <section>
      <article class="post">
        <header>
          <h1><?php echo $metaData['title']; ?></h1>
          <span class="author"><?php echo $metaData['author']; ?></span>
          <span class="date"><?php echo $metaData['date']; ?></span>
        </header>
        <section class="content">
          <?php echo $content; ?>
        </section>
      </article>
    </section>
    <footer>
      powered by <a href="http://www.imikay.com/miki" target="_blank">Miki</a>
    </footer>
  </body>
</html>