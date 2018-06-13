<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
/** @global CMain $APPLICATION */
$APPLICATION->SetTitle('Новости');
?>

<? $APPLICATION->IncludeComponent(
    'bitrix:news',
    'news.timeline-v2',
    array(
        'IBLOCK_TYPE'                     => 'content',
        'IBLOCK_ID'                       => '9',
        'NEWS_COUNT'                      => '10',
        'SORT_BY1'                        => 'ACTIVE_FROM',
        'SORT_ORDER1'                     => 'DESC',
        'SORT_BY2'                        => 'SORT',
        'SORT_ORDER2'                     => 'ASC',
        'CHECK_DATES'                     => 'Y',
        'CACHE_TYPE'                      => 'A',
        'CACHE_TIME'                      => '36000000',
        'SET_LAST_MODIFIED'               => 'Y',
        'SET_TITLE'                       => 'Y',
        'INCLUDE_IBLOCK_INTO_CHAIN'       => 'N',
        'ADD_SECTIONS_CHAIN'              => 'N',
        'ADD_ELEMENT_CHAIN'               => 'Y',
        'USE_PERMISSIONS'                 => 'N',
        'LIST_ACTIVE_DATE_FORMAT'         => 'j F Y',
        'META_KEYWORDS'                   => '-',
        'META_DESCRIPTION'                => '-',
        'BROWSER_TITLE'                   => '-',
        'DETAIL_SET_CANONICAL_URL'        => 'N',
        'DETAIL_ACTIVE_DATE_FORMAT'       => 'j F Y',
        'PAGER_TEMPLATE'                  => 'alpha-simlpe',
        'DISPLAY_TOP_PAGER'               => 'N',
        'DISPLAY_BOTTOM_PAGER'            => 'Y',
        'PAGER_SHOW_ALWAYS'               => 'N',
        'PAGER_SHOW_ALL'                  => 'N',
        'SET_STATUS_404'                  => 'Y',
        'SEF_MODE'                        => 'Y',
        'SEF_FOLDER'                      => '/news/',
        'SEF_URL_TEMPLATES'               => array(
            'news'    => '',
            'section' => '',
            'detail'  => '#ELEMENT_CODE#/'
        ),
        'VARIABLE_ALIASES'                => array(
            'news'    => array(),
            'section' => array(),
            'detail'  => array()
        ),
        'PREVIEW_TRUNCATE_LEN'            => '550',
        'USE_SHARE'                       => 'Y',
        'SHARE_TITLE'                     => 'Поделиться ссылкой',
        'SHARE_HANDLERS'                  => array(
            0 => "vkontakte",
            1 => "facebook",
            2 => "twitter",
            3 => "odnoklassniki"
        )
    )
); ?>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>