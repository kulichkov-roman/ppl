<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
/** @global CMain $APPLICATION */
$APPLICATION->SetTitle('Клиенты');
?>

<? $APPLICATION->IncludeComponent(
    'bitrix:news.list',
    'common.clients-list',
    array(
        'IBLOCK_TYPE'               => 'content',
        'IBLOCK_ID'                 => '10',
        'NEWS_COUNT'                => '5',
        'PREVIEW_TRUNCATE_LEN'      => '',
        'SORT_BY1'                  => 'SORT',
        'SORT_ORDER1'               => 'ASC',
        'FIELD_CODE'                => array(),
        'PROPERTY_CODE'             => array(
            0 => 'CLIENT_PLACE',
            1 => 'CLIENT_SITE',
            2 => 'CLIENT_SCOPE',
        ),
        'SET_TITLE'                 => 'N',
        'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
        'ADD_SECTIONS_CHAIN'        => 'N',
        'CACHE_TYPE'                => 'A',
        'CACHE_TIME'                => '36000000',
        'DISPLAY_TOP_PAGER'         => 'N',
        'DISPLAY_BOTTOM_PAGER'      => 'Y',
        'PAGER_SHOW_ALWAYS'         => 'N',
        'PAGER_TEMPLATE'            => 'alpha-simlpe',
        'PAGER_SHOW_ALL'            => 'N',
        'CUSTOM_TITLE_SHOW'         => 'Y',
        'CUSTOM_TITLE'              => 'Наши клиенты',
    )
); ?>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>