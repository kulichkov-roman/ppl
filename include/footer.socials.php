<?
global $arSocialFooter;
$arSocialFooter = array('!PROPERTY_SOCIAL_FOOTER' => false);
?>
<? $APPLICATION->IncludeComponent(
    'bitrix:news.list',
    'footer.social-icons',
    array(
        'IBLOCK_TYPE'               => 'content',
        'IBLOCK_ID'                 => '6',
        'NEWS_COUNT'                => '8',
        'SORT_BY1'                  => 'SORT',
        'SORT_ORDER1'               => 'ASC',
        'FILTER_NAME'               => 'arSocialFooter',
        'FIELD_CODE'                => array('NAME'),
        'PROPERTY_CODE'             => array('SOCIAL_ICON', 'SOCIAL_LINK', 'SOCIAL_BLANK', 'SOCIAL_HINT'),
        'SET_TITLE'                 => 'N',
        'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
        'ADD_SECTIONS_CHAIN'        => 'N',
        'CACHE_TYPE'                => 'A',
        'CACHE_TIME'                => '36000000',
        'CACHE_FILTER'              => 'Y',
    )
); ?>