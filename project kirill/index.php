<?php

require_once ( "autoloader.php" );

$data = new Data();


if ( isset( $_GET[ "action" ] ) ) {
    echo $data->getContent( $_GET[ "action" ] );
} else {
    echo $data->getContent();
}


// action = loadData -> зарежда дефаулт таблица
//          interactData  -> зарежда форма за добаване или редактиране на данно от базата информация
//          processingData ( edit | add | delete ) -> чете от формат на interactData

//          reportData -> зарежда избор за справка
//          reportLastEvent -> зарежда спратка за последното зареждане
//          reportAvarig -> зарежда средна спратка
//          reportUserChouse -> зарежда справка по параметри
