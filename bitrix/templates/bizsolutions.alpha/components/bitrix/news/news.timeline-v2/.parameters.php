<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arCurrentValues */

$arTemplateParameters = array(
    'USE_SHARE' => Array(
        'NAME'     => GetMessage('ALPHA_USE_SHARE'),
        'TYPE'     => 'CHECKBOX',
        'MULTIPLE' => 'N',
        'VALUE'    => 'Y',
        'DEFAULT'  => 'N',
        'REFRESH'  => 'Y',
    ),
);

if ($arCurrentValues['USE_SHARE'] == 'Y') {
    $arTemplateParameters['SHARE_TITLE'] = array(
        'NAME'     => GetMessage('ALPHA_SHARE_TITLE'),
        'DEFAULT'  => GetMessage('ALPHA_SHARE_DEFAULT_TITLE'),
        'TYPE'     => 'STRING',
        'MULTIPLE' => 'N',
        'COLS'     => 25,
    );

    $arTemplateParameters['SHARE_HANDLERS'] = array(
        'NAME'     => GetMessage('ALPHA_SHARE_HANDLERS'),
        'TYPE'     => 'LIST',
        'MULTIPLE' => 'Y',
        'VALUES' => array(
            'vkontakte'     => GetMessage('ALPHA_SHARE_VKONTAKTE'),
            'facebook'      => GetMessage('ALPHA_SHARE_FACEBOOK'),
            'twitter'       => GetMessage('ALPHA_SHARE_TWITTER'),
            'odnoklassniki' => GetMessage('ALPHA_SHARE_ODNOKLASSNIKI'),
            'moimir'        => GetMessage('ALPHA_SHARE_MOIMIR'),
            'lj'            => GetMessage('ALPHA_SHARE_LJ'),
            'friendfeed'    => GetMessage('ALPHA_SHARE_FRIENDFEED'),
            'moikrug'       => GetMessage('ALPHA_SHARE_MOIKRUG'),
            'gplus'         => GetMessage('ALPHA_SHARE_GPLUS'),
            'surfingbird'   => GetMessage('ALPHA_SHARE_SURFINGBIRD'),
        ),
        'DEFAULT'  => array('vkontakte', 'facebook', 'twitter', 'odnoklassniki')
    );
}