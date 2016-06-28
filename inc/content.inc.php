<?php

//--------------------------------------------------------------------------------------------------
  function pageAdd($page_url) // нужно добавить валидацию url + проверку на наличие url в базе 
    {
      $page_url = dbQuote($page_url);
      $page_md5 = md5(file_get_contents("http://$page_url"));  
      $query = "INSERT INTO `pages` (`page_url`, `compare_need`, `page_md5`, `comparison_date`, `comparison_result`, `action_need`, `action_date`)
      VALUES ('$page_url', 1, '$page_md5', NOW(), 0, 0, NOW());";
      dbQuery($query);
      echo "<br />Страница<br />$page_url<br />успешно добавлена в базу проверяемых<br /><hr />";       
    };

//--------------------------------------------------------------------------------------------------    
  function pageStop($page_url) // нужно добавить валидацию url + проверку на существование url в базе
    {
      $page_url = dbQuote($page_url);      
      $query = "UPDATE `pages` SET `compare_need` = '0' WHERE `pages`.`page_url` = '{$page_url}'";
      dbQuery($query);
      echo "<br />Для страницы<br />$page_url<br />отключены проверки. Теперь compare_need = 0<hr />";             
    };
    
//--------------------------------------------------------------------------------------------------    
  function pageStart($page_url) // нужно добавить валидацию url + проверку на существование url в базе
    {
      $page_url = dbQuote($page_url);      
      $query = "UPDATE `pages` SET `compare_need` = '1' WHERE `pages`.`page_url` = '{$page_url}'";
      dbQuery($query);
      echo "<br />Для страницы<br />$page_url<br />включены проверки. Теперь compare_need = 1<hr />";             
    };


//  echo '<b>debug</b>: добавлен content.inc.php<br />';