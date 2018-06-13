<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->createFrame()->begin();

$arClear = array('login', 'logout', 'register', 'forgot_password', 'change_password', 'MUL_MODE');
?>
<ul class="loginbar list-inline text-center">
    <? if (strlen($arResult['FatalError']) > 0) { ?>
        <li>
            <a href="<?= SITE_DIR ?>personal/?register=yes">
                <?= GetMessage('ALPHA_REGISTER_TITLE') ?>
            </a>
        </li>
        <li class="topbar-devider"></li>
        <li>
            <a href="<?= SITE_DIR ?>personal/">
                <?= GetMessage('ALPHA_LOGIN_TITLE') ?>
            </a>
        </li>
    <? } else { ?>
        <li>
            <a href="<?= SITE_DIR ?>personal/">
                <?= $arResult['User']['NAME_FORMATTED'] ?>
            </a>
        </li>
        <li class="topbar-devider"></li>
        <li>
            <a href="<?= $APPLICATION->GetCurPageParam('logout=yes', $arClear) ?>">
                <?= GetMessage('ALPHA_LOGOUT_TITLE') ?>
            </a>
        </li>
    <? } ?>
</ul>