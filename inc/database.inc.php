<?php
//--------------------------------------------------------------------------------------------------    
    function dbInitialConnect()
    {
        global $g_dbLink, $g_dblocation, $g_dbuser, $g_dbpasswd, $g_dbname, $g_dbport;
        $g_dbLink = mysqli_connect($g_dblocation, $g_dbuser, $g_dbpasswd, $g_dbname, $g_dbport);
        $error = mysqli_connect_error();
        if ($error)
            die('Unable to connect to DB');
    }
//--------------------------------------------------------------------------------------------------    
    function dbQuery($query) // запрос в БД	
    {
        global $g_dbLink;
        $result = mysqli_query($g_dbLink, $query);
        return ($result !== false);    
    }
//--------------------------------------------------------------------------------------------------    
    function dbQuote($value) // обрезает sql инъекционные символы
    {
        global $g_dbLink;
        return mysqli_real_escape_string($g_dbLink, $value);    
    }
//--------------------------------------------------------------------------------------------------    
    function dbGetLastInsertId() // пока не применяется
    {
        global $g_dbLink;
        return mysqli_insert_id($g_dbLink);    
    }
//--------------------------------------------------------------------------------------------------    
    function dbQueryGetResult($query) // запрос с возвратом результата массивом
    {
        global $g_dbLink;
        $data = array();
        $result = mysqli_query($g_dbLink, $query);
        if ($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                array_push($data, $row);	
            }
            mysqli_free_result($result);        
        }        
        return $data;    
    }
//--------------------------------------------------------------------------------------------------
    function getData($query) // разобраться, почему такая вложенность большая получилась
    {
        $array = array(dbQueryGetResult($query));
        $result = array_pop($array);
        $result = array_pop($result);
        $result = array_pop($result); 
        return $result;
    } 


//--------------------------------------------------------------------------------------------------    
//  echo '<b>debug</b>: добавлен database.inc.php<br />';