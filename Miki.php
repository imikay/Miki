<?php
class Mika
{
  private $config;
  private $instance;
  private $options;
  
  public function __construct(array $options)
  {
    $this->config = new Config($this->options);    
  }
  
  public function getConfig()
  {
    return $this->config;
  }      
}