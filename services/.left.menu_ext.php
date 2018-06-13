<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$aMenuLinks = $APPLICATION->IncludeComponent(
    'bitrix:menu.sections',
    '',
    array(
        'IBLOCK_TYPE'      => 'content',
        'IBLOCK_ID'        => IBLOCK_SERVICES,
        'SECTION_ID'       => '',
        'DEPTH_LEVEL'      => '2',
        'IS_SEF'           => 'Y',
        'SEF_BASE_URL'     => '/services/',
        'SECTION_PAGE_URL' => '#SECTION_CODE_PATH#/',
        'DETAIL_PAGE_URL'  => '#SECTION_CODE_PATH#/#CODE#/',
        'CACHE_TYPE'       => 'A',
        'CACHE_TIME'       => '3600'
    ),
    false
);