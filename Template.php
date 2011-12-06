<?php
class Template
{
  private $content;
  private $config;
  private $vars = array();
  
  public function __construct($vars, $config)
  {
    $this->vars = $vars;
    $this->config = $config;
  }
    
  public function render()
  {
    $layout = $config;
    
    $this->content
    echo $this->content;
  }
}