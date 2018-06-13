<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arCurrentValues */

$arTemplateParameters = array(
    'CUSTOM_TITLE_SHOW' => array(
        'PARENT'  => 'BASE',
        'NAME'    => GetMessage('ALPHA_CP_CUSTOM_TITLE_SHOW'),
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y',
    )
);

if ($arCurrentValues['CUSTOM_TITLE_SHOW'] == 'Y') {
    $arTemplateParameters['CUSTOM_TITLE'] = array(
        'PARENT'  => 'BASE',
        'NAME'    => GetMessage('ALPHA_CP_CUSTOM_TITLE'),
        'TYPE'    => 'STRING',
        'DEFAULT' => '',
    );
}