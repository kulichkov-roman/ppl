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
$arFields = array('LAST_NAME', 'NAME', 'SECOND_NAME', 'LOGIN', 'PERSONAL_PHONE', 'EMAIL', 'NEW_PASSWORD', 'NEW_PASSWORD_CONFIRM');
?>

<div class="row">
    <!-- Profile Content -->
    <div class="col-md-12">
        <div class="profile-body margin-bottom-20">
            <div class="tab-v1">
                <ul class="nav nav-justified nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#profile"><?= GetMessage('ALPHA_PROFILE_TAB_1_NAME') ?></a></li>
                    <li></li><li></li><li></li>
                </ul>
                <div class="tab-content">
                    <form name="form1" action="<?= $arResult['FORM_TARGET'] ?>" method="post" enctype="multipart/form-data" role="form">
                        <?= $arResult['BX_SESSION_CHECK'] ?>
                        <input type="hidden" name="lang" value="<?= LANG ?>"/>
                        <input type="hidden" name="ID" value=<?= $arResult['ID'] ?>/>

                        <div id="profile" class="profile-edit tab-pane fade in active">
                            <? if (!empty($arResult['strProfileError'])) { ?>
                                <div class="alert alert-danger"><?= $arResult['strProfileError'] ?></div>
                            <? } ?>

                            <? if ($arResult['DATA_SAVED'] == 'Y') { ?>
                                <div class="alert alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <?= GetMessage('ALPHA_PROFILE_DATA_SAVED') ?>
                                </div>
                            <? } ?>

                            <h2 class="heading-md"><?= GetMessage('ALPHA_PROFILE_TAB_1_TITLE') ?></h2>
                            <p><?= GetMessage('ALPHA_PROFILE_TAB_1_DESCRIPTION') ?></p>
                            <br/>

                            <dl class="dl-horizontal">
                                <? // Profile Fields
                                foreach ($arFields as $fieldCode) {
                                    $fieldId = 'personal_' . ToLower($fieldCode);
                                    $fieldValue = $arResult['arUser'][$fieldCode];
                                    $fieldRequired = (($arResult['EMAIL_REQUIRED'] && $fieldCode == 'EMAIL') || $fieldCode == 'LOGIN');
                                    $fieldType = 'text';
                                    if ($fieldCode == 'NEW_PASSWORD' || $fieldCode == 'NEW_PASSWORD_CONFIRM') {
                                        $fieldType = 'password';
                                        $fieldValue = '';
                                        if (!empty($arResult['arUser']['EXTERNAL_AUTH_ID'])) continue;
                                    }
                                    ?>
                                    <dt>
                                        <label for="<?= $fieldId ?>">
                                            <?= GetMessage('ALPHA_FIELD_' . $fieldCode . '_LABEL') ?>
                                            <? if ($fieldRequired) { ?><span class="color-red">*</span><? } ?>
                                        </label>
                                    </dt>
                                    <dd>
                                        <input type="<?= $fieldType ?>" class="form-control" id="<?= $fieldId ?>" name="<?= $fieldCode ?>" value="<?= $fieldValue ?>">
                                    </dd>
                                    <hr/>
                                <? } ?>
                            </dl>

                            <button class="btn-u" type="submit" name="save" value="Y"><?= GetMessage('ALPHA_MAIN_SAVE') ?></button>
                            <button class="btn-u btn-u-default" type="reset"><?= GetMessage('ALPHA_MAIN_RESET') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Profile Content -->
</div><!--/end row-->