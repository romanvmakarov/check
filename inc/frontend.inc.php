<?php

// функции работы с фронтендом: отображение контента страниц, действия в результате сабмита форм

function frontendFirstPage(){
    actions();
    actionForm();
};
//--------------------------------------------------------------------------------------------------
function actionForm(){
    echo "
    <form action='' method='post'>
        <input type='text' name='page_url'><br />
        <input type='radio' name='action' value='add'>Добавить<br />      
        <input type='radio' name='action' value='stop'>Приостановить<br />
        <input type='radio' name='action' value='start'>Возобновить<br />
        <input type='radio' name='action' value='check'>Проверить<br />
        <input type='submit' value='OK'>
    </form>
    ";
};
//-------------------------------------------------------------------------------------------------- 
function actions(){
    if (isset($_POST['page_url'])) {
        $page_url = $_POST['page_url'];
        urlValidation($page_url);
        if (isset($_POST['action'])){
            $action = $_POST['action'];
            if ($action == 'add') {pageAdd($page_url);};
            if ($action == 'stop') {pageStop($page_url);};
            if ($action == 'start') {pageStart($page_url);};
            if ($action == 'check') {md5Check($page_url);
            }
        else {
            echo "Выберите действие";
        };
        };
    } else {
        echo "Введите адрес страницы";
    };
};