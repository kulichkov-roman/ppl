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
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <?
        $alertClass = 'alert alert-success';
        if (in_array($arResult['MESSAGE_CODE'], array('E01', 'E04', 'E05', 'E07'))) {
            $alertClass = 'alert alert-danger';
        }

        //here you can place your own messages
        switch ($arResult['MESSAGE_CODE']) {
            case 'E01':
                ?><? //When user not found
                break;
            case 'E02':
                ?><? //User was successfully authorized after confirmation
                break;
            case 'E03':
                ?><? //User already confirm his registration
                break;
            case 'E04':
                ?><? //Missed confirmation code
                break;
            case 'E05':
                ?><? //Confirmation code provided does not match stored one
                break;
            case 'E06':
                ?><? //Confirmation was successfull
                break;
            case 'E07':
                ?><? //Some error occured during confirmation
                break;
        } ?>

        <div class="<?= $alertClass ?>">
            <?= $arResult['MESSAGE_TEXT']?>
        </div>

        <? if($arResult['SHOW_FORM']) { ?>
            <form method="post" class="reg-page" action="<?= $arResult['FORM_ACTION']?>">
                <div class="reg-header">
                    <h2><?= GetMessage('ALPHA_CONFIRM_TITLE') ?></h2>
                    <p><?= GetMessage('ALPHA_CONFIRM_DESCRIPTION') ?></p>
                </div>

                <input type="hidden" name="<?= $arParams['USER_ID'] ?>" value="<?= $arParams['USER_ID'] ?>">

                <?
                $userLogin = $arResult['USER']['LOGIN'];
                if (strlen($arResult['LOGIN']) > 0) {
                    $userLogin = $arResult['LOGIN'];
                }
                ?>
                <div class="form-group has-feedback">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control restoreField" name="<?= $arParams['LOGIN']?>" placeholder="<?= GetMessage('ALPHA_CONFIRM_LOGIN') ?>" value="<?= $userLogin ?>"/>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="text" class="form-control restoreField" name="<?= $arParams['CONFIRM_CODE']?>" placeholder="<?= GetMessage('ALPHA_CONFIRM_CODE') ?>" value="<?= $arResult["CONFIRM_CODE"]?>"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <button class="btn-u pull-right" type="submit"><?= GetMessage('ALPHA_CONFIRM_SUBMIT') ?></button>
                    </div>
                </div>
            </form>
        <? } ?>
    </div>
</div>

<? if (!$arResult['SHOW_FORM'] && !$USER->IsAuthorized()) {
    $APPLICATION->IncludeComponent('bitrix:system.auth.authorize', '', array());
} ?>
        