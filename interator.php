<?php

//var_dump($iter->getLines());



class ExampleIter implements Iterator
{

    protected $storage = [];

    public function set($key, $val)
    {
        $this->storage[$key] = $val;
    }

    public function get($key) 
    {
        return $this->storage[$key];
    }

    public function current() : mixed 
    {
        return current($this->storage);
    }

    public function key() : mixed
    {
        return key($this->storage);
    }

    public function next(): void
    {
        next($this->storage);
    }

    public function rewind(): void
    {
        reset($this->storage);
    }

    public function valid(): bool
    {
        return null !== key($this->storage);
    }

    public function remove() : void 
    { 
        unset($this->storage[$this->key()]);
    }
}

$iter = new ExampleIter;
$fp = @fopen("int.txt", "r");

if ($fp) {
    $id = 0; 
    while (($buffer = fgets($fp, 4096)) !== false) {
        $iter->set($id, $buffer);
        ++$id;
    }
    if (!feof($fp)) {
        echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
    }
    fclose($fp);

}

foreach ($iter as $key => $value){
    if(strpos($value, 'title') !== false)
    { 
        $iter->remove();
    }
    elseif(strpos($value, 'description') !== false)
    {
        $iter->remove();
    }
    elseif(strpos($value, 'keywords') !== false)
    {
        $iter->remove();
    }
    else 
    { 
        var_dump($key, $value);
    }
}
 
?>
