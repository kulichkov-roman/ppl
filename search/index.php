<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
/** @global CMain $APPLICATION */
$APPLICATION->SetTitle('Поиск');
?>
    <? $APPLICATION->IncludeComponent(
        'bitrix:search.page',
        'common.search',
        array(
            'RESTART'                => 'N',
            'NO_WORD_LOGIC'          => 'N',
            'CHECK_DATES'            => 'N',
            'USE_TITLE_RANK'         => 'N',
            'DEFAULT_SORT'           => 'rank',
            'FILTER_NAME'            => '',
            'arrFILTER'              => array('no'),
            'SHOW_WHERE'             => 'N',
            'arrWHERE'               => array(),
            'SHOW_WHEN'              => 'N',
            'PAGE_RESULT_COUNT'      => '10',
            'AJAX_MODE'              => 'N',
            'AJAX_OPTION_JUMP'       => 'N',
            'AJAX_OPTION_STYLE'      => 'Y',
            'AJAX_OPTION_HISTORY'    => 'N',
            'AJAX_OPTION_ADDITIONAL' => '',
            'CACHE_TYPE'             => 'A',
            'CACHE_TIME'             => '3600',
            'USE_LANGUAGE_GUESS'     => 'Y',
            'DISPLAY_TOP_PAGER'      => 'N',
            'DISPLAY_BOTTOM_PAGER'   => 'Y',
            'PAGER_TITLE'            => 'Результаты поиска',
            'PAGER_SHOW_ALWAYS'      => 'N',
            'PAGER_TEMPLATE'         => 'alpha-simlpe',
            'SHOW_ITEM_TAGS'         => 'Y',
            'TAGS_INHERIT'           => 'Y',
            'SHOW_ITEM_DATE_CHANGE'  => 'Y',
            'SHOW_ORDER_BY'          => 'Y',
            'SHOW_TAGS_CLOUD'        => 'N',
            'arrFILTER_main'         => array('')
        )
    ); ?>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>