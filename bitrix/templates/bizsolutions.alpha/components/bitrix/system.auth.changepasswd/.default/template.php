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
$APPLICATION->SetTitle(GetMessage('ALPHA_CHANGE_TITLE'));
$arClear = array('login', 'logout', 'register', 'forgot_password', 'change_password');
?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <form id="regForm" class="reg-page" name="bform" method="post" target="_top" action="<?= $arResult['AUTH_URL'] ?>">
                <div class="reg-header">
                    <h2><?= GetMessage('ALPHA_CHANGE_TITLE') ?></h2>
                    <p>
                        <?= GetMessage('ALPHA_CHANGE_DESCRIPTION_1') ?>
                        <a href="<?= $APPLICATION->GetCurPageParam('login=yes', $arClear) ?>"><?= GetMessage('ALPHA_CHANGE_DESCRIPTION_2') ?></a>
                        <?= GetMessage('ALPHA_CHANGE_DESCRIPTION_3') ?>
                    </p>
                </div>

                <? // Message Block
                if (isset($arParams['AUTH_RESULT']['MESSAGE']) && strlen($arParams['AUTH_RESULT']['MESSAGE']) > 0) {
                    $alertClass = 'alert alert-success';
                    if ($arParams['AUTH_RESULT']['TYPE'] == 'ERROR') {
                        $alertClass = 'alert alert-danger';
                    }
                    ?>
                    <div id="messBlock" class="<?= $alertClass ?>"><?= $arParams['~AUTH_RESULT']['MESSAGE'] ?></div>
                <? } else { ?>
                    <div id="messBlock" class="alert alert-danger hidden"></div>
                <? } ?>

                <? if (strlen($arResult['BACKURL']) > 0) { ?>
                    <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>" />
                <? } ?>

                <input type="hidden" name="AUTH_FORM" value="Y">
                <input type="hidden" name="TYPE" value="CHANGE_PWD">

                <label for="user_login"><?= GetMessage('ALPHA_FIELD_LOGIN') ?> <span class="color-red">*</span></label>
                <div class="form-group has-feedback">
                    <input id="user_login" class="form-control margin-bottom-20" type="text" name="USER_LOGIN" value="<?= $arResult['LAST_LOGIN'] ?>">
                </div>

                <label for="user_checkword"><?= GetMessage('ALPHA_FIELD_CHECKWORD') ?> <span class="color-red">*</span></label>
                <div class="form-group has-feedback">
                    <input id="user_checkword" class="form-control margin-bottom-20" type="text" name="USER_CHECKWORD" value="<?= $arResult['USER_CHECKWORD'] ?>">
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label for="user_password"><?= GetMessage('ALPHA_FIELD_PASSWORD') ?> <span class="color-red">*</span></label>
                        <div class="form-group has-feedback">
                            <input id="user_password" class="form-control margin-bottom-20" type="password" name="USER_PASSWORD">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="user_confirm_password"><?= GetMessage('ALPHA_FIELD_CONFIRM') ?> <span class="color-red">*</span></label>
                        <div class="form-group has-feedback">
                            <input id="user_confirm_password" class="form-control margin-bottom-20" type="password" name="USER_CONFIRM_PASSWORD">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-6 text-right">
                        <button class="btn-u" type="submit"><?= GetMessage('ALPHA_FIELD_CHANGE') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(function () {
            var $messBlock = $('#messBlock');
            $('#regForm').bootstrapValidator({
                container: '#messBlock',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    USER_LOGIN: {
                        validators: {
                            notEmpty: {
                                message: '<?= GetMessage('ALPHA_ERROR_LOGIN')?>'
                            },
                            stringLength: {
                                min: 3,
                                message: '<?= GetMessage('ALPHA_ERROR_LOGIN')?>'
                            }
                        }
                    },
                    USER_CHECKWORD: {
                        validators: {
                            notEmpty: {
                                message: '<?= GetMessage('ALPHA_ERROR_CHECKWORD')?>'
                            }
                        }
                    },
                    USER_PASSWORD: {
                        validators: {
                            notEmpty: {
                                message: '<?= GetMessage('ALPHA_ERROR_PASSWORD')?>'
                            },
                            stringLength: {
                                min: 6,
                                message: '<?= GetMessage('ALPHA_ERROR_PASSWORD')?>'
                            }
                        }
                    },
                    USER_CONFIRM_PASSWORD: {
                        validators: {
                            notEmpty: {
                                message: '<?= GetMessage('ALPHA_ERROR_CONFIRM')?>'
                            },
                            identical: {
                                field: 'USER_PASSWORD',
                                message: '<?= GetMessage('ALPHA_ERROR_CONFIRM')?>'
                            }
                        }
                    }
                }
            }).on('error.field.bv', function () {
                // Show Message Block if has errors
                $messBlock.removeClass('hidden');
            }).on('success.field.bv', function () {
                // Hide Message Block if has no errors
                if ($messBlock.find('.help-block:visible').length <= 0) {
                    $messBlock.addClass('hidden');
                }
            });
        });
    </script>