<? $APPLICATION->IncludeComponent(
    'bitrix:menu',
    'sidebar.menu',
    array(
        'ROOT_MENU_TYPE'        => 'left',
        'MAX_LEVEL'             => '2',
        'CHILD_MENU_TYPE'       => 'left',
        'USE_EXT'               => 'N',
        'MENU_CACHE_TYPE'       => 'A',
        'MENU_CACHE_TIME'       => '3600',
        'MENU_CACHE_USE_GROUPS' => 'Y',
        'CUSTOM_TITLE_SHOW'     => 'N',
    )
); ?>