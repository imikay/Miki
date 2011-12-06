<?php
class Config implements ArrayAccess
{
  private $options = array();
  
  public function __construct(array $options)
  {
    $this->options = array_merge($this->options, $options);
  }

  public function offsetExists($offset)
  {
    return isset($this->options[$offset]);
  }
  
  public function offsetUnset($offset)
  {
    unset($this->options[$offset]);
  }
  
  public function offsetSet($offset, $value)
  {
    $this->options[$offset] = $value;
  }
  
  public function offsetGet($offset)
  {
    return isset($this->options[$offset]) ? $this->options[$offset] : null;
  }  
}