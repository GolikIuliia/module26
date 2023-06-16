<?php
// interface interfaceIterator extends Traversable {
//     /* Методы */
//     public function rewind();
//     public function newLine($str);
//     public function next();
//     public function valid();
//     public function getTag(string $tag);
//     public function getLines();
//     }
    
class myIterator //implements interfaceIterator
{
    private $line;
    private $ar = [];

    public function __construct() 
    { 
        $this->line = 0;
    }

    public function rewind(): void {
        //var_dump(__METHOD__);
        $this->line = 0;
    }

    public function newLine($str) {
       // var_dump(__METHOD__);
        return $this->ar[] = $str;
    }

    public function next(): void {
       // var_dump(__METHOD__);
        ++$this->line;
    }

    public function valid(): bool {
        //var_dump(__METHOD__);
        return isset($this->ar[$this->line]);
    }

    public function getTag(string $tag) 
    { 
        return (strpos($this->ar[$this->line], $tag) !== false);
    }

    public function getLines()
    { 
        return $this->ar;
    }

    public function deleteLine() 
    { 
        $this->ar[$this->line] = NULL;
    }

    public function current() 
    {
        return $this->ar[$this->line];
    }
}
$iter = new myIterator;
$fp = @fopen("int.txt", "r");
if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $iter->newLine($buffer); 
    }
    if (!feof($fp)) {
        echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
    }
    fclose($fp);

}
foreach ($iter as $key => $value){
    var_dump($key, $value);
    echo "\n";
}
//var_dump($iter->getLines());

?>