<?php
// функции проверки всего и вся: url, контент и т.п.

//-------------------------------------------------------------------------------------------------- 
  function urlValidation($page_url)
  {
      if (preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
          "(?::[а-яёa-z0-9_-]{1,32})?@)?)?(?:(?:[а-яёa-z0-9-]{1,128}\.)+(?:com|net|".
          "org|edu|gov|biz|info|aero|travel|inc|name|[a-z]{2}|рф|xn--p1ai)|(?!0)(?:(?".
          "!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(:[0-9]{1,5})?(?:/[а-яa-z0-9.,_@%\(\)\*&".
          "?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i",$page_url) && get_headers($page_url))
      {
          echo "$page_url OK, valid";
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