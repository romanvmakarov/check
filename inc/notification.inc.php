<?php

  function emailNotification ($email, $changedPages)
  {
    mail ($email, 'Страницы с изменённым контентом:<br />$changedPages');
  };

  function onlineNotification ($email, $changedPages)
  {
    echo 'Страницы с изменённым контентом:<br />$changedPages';
  };

echo '<b>debug</b>: добавлен notification.inc.php<br />';