<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
/** @global CMain $APPLICATION */
$APPLICATION->SetTitle('Услуги');
?>

<? $APPLICATION->IncludeComponent(
    'bitrix:news',
    'services',
    array(
        'IBLOCK_TYPE'               => 'content',
        'IBLOCK_ID'                 => '14',
        'NEWS_COUNT'                => '6',
        'SORT_BY1'                  => 'ACTIVE_FROM',
        'SORT_ORDER1'               => 'DESC',
        'SORT_BY2'                  => 'SORT',
        'SORT_ORDER2'               => 'ASC',
        'CHECK_DATES'               => 'Y',
        'PREVIEW_TRUNCATE_LEN'      => '',
        'LIST_ACTIVE_DATE_FORMAT'   => 'd.m.Y',
        'LIST_FIELD_CODE'           => array(),
        'LIST_PROPERTY_CODE'        => array(),
        'DETAIL_ACTIVE_DATE_FORMAT' => 'd.m.Y',
        'DETAIL_FIELD_CODE'         => array(),
        'DETAIL_PROPERTY_CODE'      => array(
            0 => 'SERVICE_INCUT_1',
            1 => 'SERVICE_INCUT_2',
            2 => 'SERVICE_TAB_1',
            3 => 'SERVICE_TAB_2',
        ),
        'SET_TITLE'                 => 'Y',
        'SET_STATUS_404'            => 'Y',
        'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
        'ADD_SECTIONS_CHAIN'        => 'Y',
        'ADD_ELEMENT_CHAIN'         => 'Y',
        'USE_PERMISSIONS'           => 'N',
        'CACHE_TYPE'                => 'A',
        'CACHE_TIME'                => '36000000',
        'DISPLAY_TOP_PAGER'         => 'N',
        'DISPLAY_BOTTOM_PAGER'      => 'Y',
        'PAGER_TITLE'               => 'Услуги',
        'PAGER_SHOW_ALWAYS'         => 'N',
        'PAGER_TEMPLATE'            => 'alpha-simlpe',
        'PAGER_SHOW_ALL'            => 'N',
        'SEF_MODE'                  => 'Y',
        'SEF_FOLDER'                => '/services/',
        'SEF_URL_TEMPLATES'         => array(
            'news'    => '',
            'section' => '#SECTION_CODE_PATH#/',
            'detail'  => '#SECTION_CODE_PATH#/#ELEMENT_CODE#/'
        ),
        'VARIABLE_ALIASES'          => array(
            'news'    => array(),
            'section' => array(),
            'detail'  => array()
        ),
        'USE_SHARE'                 => 'Y',
        'SHARE_TITLE'               => 'Поделиться ссылкой',
        'SHARE_HANDLERS'            => array(
            0 => "vkontakte",
            1 => "facebook",
            2 => "twitter",
            3 => "odnoklassniki"
        )
    )
); ?>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>