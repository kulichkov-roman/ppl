<!-- Panel with News Slider -->
<? $APPLICATION->IncludeComponent(
    'bitrix:news.list',
    'index.news-slider',
    array(
        'IBLOCK_TYPE'               => 'content',
        'IBLOCK_ID'                 => '9',
        'NEWS_COUNT'                => '6',
        'PREVIEW_TRUNCATE_LEN'      => '200',
        'SORT_BY1'                  => 'SORT',
        'SORT_ORDER1'               => 'ASC',
        'FIELD_CODE'                => array(),
        'PROPERTY_CODE'             => array(),
        'DETAIL_URL'                => '/news/#ELEMENT_CODE#/',
        'SET_TITLE'                 => 'N',
        'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
        'ADD_SECTIONS_CHAIN'        => 'N',
        'CACHE_TYPE'                => 'A',
        'CACHE_TIME'                => '36000000',
        'CUSTOM_NAME'               => 'Последние новости',
        'CUSTOM_MORE'               => 'Все новости',
    )
); ?>
<!-- End Panel with News Slider -->