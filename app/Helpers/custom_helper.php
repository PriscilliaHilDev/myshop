<?php
// Function: used to convert a string to revese in order

if (!function_exists("getCat")) {
 function readGetValueTabByKey($id = null, $tabCategory = null, $name=null) {
        
    foreach($tabCategory as $cat)
    { 
        if($cat[$name] == $id )
        {
            return  $cat;
        }

    }

    return null;
}
}
