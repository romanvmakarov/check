<?php

//-------------------------------------------------------------------------------------------------- 
  function urlValidation($page_url)
  {
      if (preg_match("/(https?:\/\/)?(www\.)?([-а-яa-zёЁцушщхъфырэчстью0-9_\.]{2,}\.)(рф|[a-z]{2,6})((\/[-а-яёЁцушщхъфырэчстьюa-z0-9_]{1,})?\/?([a-z0-9_-]{2,}\.[a-z]{2,6})?(\?[a-z0-9_]{2,}=[-0-9]{1,})?((\&[a-z0-9_]{2,}=[-0-9]{1,}){1,})?)/i",$page_url))
      {
          echo "$page_url Valid";
      }
      else
      {
          echo "$page_url NOT Valid";
      }
  };

//--------------------------------------------------------------------------------------------------

  function md5Check($page_url)
    {
      $page_url = dbQuote ($page_url);
      echo "<br />Проверяется страница $page_url<br />";    
      $contentMd5 = md5(file_get_contents("http://$page_url"));
      $query = "SELECT page_md5 FROM `pages` WHERE `page_url` = '{$page_url}'";
      $baseMd5 = getData($query);

      echo "<br />Сравнение MD5:<br />$baseMd5<br />$contentMd5<br />";

      if ($baseMd5 !== $contentMd5)
      {
        $query = "UPDATE `pages` SET `comparison_result` = '1' WHERE `pages`.`page_url` = '{$page_url}'";
        dbQuery($query);
        echo "<br />Содержимое страницы изменилось, теперь comparison_result = 1";
        
        $query = "UPDATE `pages` SET `page_md5` = '{$contentMd5}' WHERE `pages`.`page_url` = '{$page_url}'";
        dbQuery($query);
        echo "<br />MD5 в базе обновлён";        
      }
      else 
      {
        echo "<br />Содержимое страницы не изменилось, comparison_result не меняем<hr />";
      };
    };
    
//--------------------------------------------------------------------------------------------------    
echo '<b>debug</b>: добавлен check.inc.php<br />';