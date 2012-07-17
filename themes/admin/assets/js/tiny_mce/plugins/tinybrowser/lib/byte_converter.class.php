<?php

/**********************************************************************************************************
*
*  byte converter class
*  @filename: byte_converter.class.php
*  Php version PHP5.
*  version: 0.2
*  @author: Ersin Guvenc <eguvenc@gmail.com>  (C) 2008 - 2009.
*  Web: http://develturk.com
*  @license http://opensource.org/licenses/lgpl-license.php GNU Lesser General Public License Version 2.1
*
*/

//some details .. http://en.wikipedia.org/wiki/Byte
//catch all error.. you can customize exception class.look at php5 manual.
//Thanks Leo Venturini for some bugs in version 0.1.  

Class byte_Exception extends Exception 
{
    function __toString(){
    return __CLASS__ . ": [Error]: {$this->getMessage()} [Line]: {$this->getLine()}\n";
    }
}

/* Simple Calculator */
Class calc 
{
private static $meter = "1024";
    //static function compute
    public static function compute($input,$operator,$iterate){
        switch ($operator) {
        case '*':
            $total = $input * self::$meter;
            for($i=1; $i<=$iterate-1; $i++)
            $total = $total * self::$meter;
            break;
        case '/':
            $total = $input / self::$meter;
            for($i=1; $i<=$iterate-1; $i++)
            $total = $total / self::$meter;
            break;
        }
        return $total;
    }
}

Class byte_converter 
{

public $format = "";  //incoming format string.
public $toFormat = ""; //output format string.
public $integer = "";  //input number integer.
/* data  types array */
public $type = array('b',      //0  byte
                        'kb',  //1  kilo
                        'mb',  //2  mega
                        'gb',  //3  giga
                        'tb',  //4  tera
                        'pb',  //5  peta
                        'eb',  //6  exa
                        'zb',  //7  zetta
                        'yb'); //8  yotta

public $limit = ""; //calculate limit for data types..
private $result = array();   //auto convert result associative array.


    function _set_params($integer,$format,$toFormat)
    {
        $this->integer = $integer;
        $this->format = strtolower($format);
        $this->toFormat = $toFormat;
        //$this->cut_array($this->limit);
    }

    //set limit for control the data types..
    function set_limit($type)
    {
        $this->limit = $type;
    }

    /* get right operator  */
    function get_operator()
    {
        if($this->get_key($this->format) > $this->get_key($this->toFormat))
        {
            $operator = "*";
            
        }elseif($this->get_key($this->format) < $this->get_key($this->toFormat))
        {
            $operator = "/";
        }
        return $operator;
    }

    /* get key type  */
    function get_key($type)
    {
        $key = array_keys($this->type,$type);
        return $key[0];
    }

    /* start manual convert process*/
    function convert($integer,$format,$toFormat)
    {
        $this->_set_params($integer,$format,$toFormat);
        $iterate = $this->get_key($this->format) - $this->get_key($this->toFormat);
        
        if($iterate < 0)
        $iterate = $iterate * -1; //turn to positive
        
        $operator = $this->get_operator();
        return calc::compute($this->integer,$operator,$iterate);
    }  //end convert method
    

    /* cut array function for limit to data types.. */
    function cut_array($input='')
    {
        if($input == "")
        return FALSE;
        
        $key = $this->get_key($input);
        $this->type = array_slice($this->type, 0, $key);
    }

     /* basic array delete. */
    function array_delete($array,$val)
    {
        if(!in_array($val,$this->type,true))
        throw new byte_Exception('This is not an array ! '.__FUNCTION__.' error!');
        
        $new = array();
        foreach($array as $k=>$v)
        {
            if(is_array($v))
            throw new byte_Exception('This is not a flat array ! '.__FUNCTION__.' error!');
            
            if($val !== $v)
            {
                $new[$k] = $v;
            }
        }
        
        return $new;
    }

    /* auto convert to another formats it returns associative array */
    function auto($integer,$format)
    {
    //get new types except $format
        $this->cut_array($this->limit);
        $new_types = $this->array_delete($this->type,$format);
        
        //run auto convert
        $result = array();
        foreach($new_types as $toFormat)
        {
            //$byte = new byte_converter;
            $this->result[$toFormat] = $this->convert($integer,$format,$toFormat);
        }
        return $this->result;
    }

} //end of the byte converter class...


/* EXAMPLE MANUAL CONVERT
try{
$byte = new byte_converter;
$total = $byte->convert("128849018880","b","kb");
echo $total;
}catch(Exception $e) {echo $e;}

//OUTPUT 125829120

/* EXAMPLE AUTO COVERT

try{
$byte = new byte_converter;
$byte->set_limit("tb"); //show types which before the tera byte
$result = $byte->auto("1048576000","kb");
print_r($result);
}catch (Exception $e) {echo $e;}

//OUTPUT

Array (
[b] => 1073741824000
[mb] => 1024000
[gb]=> 1000
//limit
[tb] => 0.9765625
[pb] => 0.000953674316406
[eb] => 9.31322574615E-7
[zb] => 9.09494701773E-10
[yb] => 8.881784197E-13 )
*/
?>