<?php
/* @global $modx */
$eventName = $modx->event->name;

if ($eventName == 'OnLoadWebDocument') {

    $tvName = 'hitsViews';
    $tvCaption = 'Счетчик визитов hitsViews';
    $create = 0;


    $tv = $modx->resource->getTVValue($tvName);

    //Создает tv в первый раз из под админа
    if ($tv===NULL) {
        $collection_templates = $modx->getCollection('modTemplate');

        $templates = array();
        foreach ($collection_templates as $template) {
            $templates[] = array('access' => true, 'id' => $template->id);

        }

        //Создаем TV
        $response = $modx->runProcessor('element/tv/create', array(
            'name' => $tvName,
            'caption' => $tvCaption,
            'category' => 0,
            'type' => 'number',
            'default_text' => 0,
            'templates' => $templates,
        ));


        $tv = "0";
    }

    $tvVal = (int) $tv;
    //savecount
    $modx->resource->setTVValue($tvName, $tvVal+=1);
    $modx->resource->save();
}