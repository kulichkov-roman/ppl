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

use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__DIR__);

$useTerms = $arParams['BS_DISABLE_CONFIRM'] != 'Y';

$APPLICATION->SetTitle(Loc::getMessage('BS_REGISTER_TITLE'));
$arClear = array('login', 'logout', 'register', 'forgot_password', 'change_password');
?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <form id="regForm" class="reg-page" name="bform" action="<?= $arResult['AUTH_URL'] ?>" method="post">
                <div class="reg-header">
                    <h2><?= Loc::getMessage('BS_REGISTER_TITLE') ?></h2>
                    <p>
                        <?= Loc::getMessage('BS_TEXT_HAS_ACCOUNT_1') ?>
                        <a href="<?= $APPLICATION->GetCurPageParam('login=yes', $arClear) ?>"><?= Loc::getMessage('BS_TEXT_HAS_ACCOUNT_2') ?></a>
                        <?= Loc::getMessage('BS_TEXT_HAS_ACCOUNT_3') ?>
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
                    <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>"/>
                <? } ?>

                <input type="hidden" name="AUTH_FORM" value="Y"/>
                <input type="hidden" name="TYPE" value="REGISTRATION"/>

                <label for="user_name"><?= Loc::getMessage('BS_FIELD_NAME') ?></label>
                <div class="form-group has-feedback">
                    <input id="user_name" class="form-control margin-bottom-20" type="text" name="USER_NAME" value="<?= $arResult['USER_NAME'] ?>">
                </div>

                <label for="user_last_name"><?= Loc::getMessage('BS_FIELD_LAST_NAME') ?></label>
                <div class="form-group has-feedback">
                    <input id="user_last_name" class="form-control margin-bottom-20" type="text" name="USER_LAST_NAME" value="<?= $arResult['USER_LAST_NAME'] ?>">
                </div>

                <label for="user_login"><?= Loc::getMessage('BS_FIELD_LOGIN') ?> <span class="color-red">*</span></label>
                <div class="form-group has-feedback">
                    <input id="user_login" class="form-control margin-bottom-20" type="text" name="USER_LOGIN" value="<?= $arResult['USER_LOGIN'] ?>">
                </div>

                <label for="user_email"><?= Loc::getMessage('BS_FIELD_EMAIL') ?> <span class="color-red">*</span></label>
                <div class="form-group has-feedback">
                    <input id="user_email" class="form-control margin-bottom-20" type="text" name="USER_EMAIL" value="<?= $arResult['USER_EMAIL'] ?>">
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label for="user_password"><?= Loc::getMessage('BS_FIELD_PASSWORD') ?> <span class="color-red">*</span></label>
                        <div class="form-group has-feedback">
                            <input id="user_password" class="form-control margin-bottom-20" type="password" name="USER_PASSWORD">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="user_confirm_password"><?= Loc::getMessage('BS_FIELD_CONFIRM') ?> <span class="color-red">*</span></label>
                        <div class="form-group has-feedback">
                            <input id="user_confirm_password" class="form-control margin-bottom-20" type="password" name="USER_CONFIRM_PASSWORD">
                        </div>
                    </div>
                </div>

                <? // Personal Data
                if ($useTerms)
                {
                    $termsLink = SITE_DIR . ltrim(Option::get(BS_MODULE_ID, 'termsLink'), '/');
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="terms-block">
                                    <input type="checkbox" name="USER_TERMS">
                                    <span><?= Loc::getMessage('BS_CONFIRM_TITLE_1') ?><? if (strlen($termsLink) > 0) { ?><a href="<?= $termsLink ?>" target="_blank"><?= Loc::getMessage('BS_CONFIRM_TITLE_2') ?></a><? } else { ?><?= Loc::getMessage('BS_CONFIRM_TITLE_2') ?><? } ?></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            $('.terms-block').click(function() {
                                var $submit = $(this).parents('form').find('[type="submit"]');
                                var $checkbox = $(this).find('[type="checkbox"]');

                                if ($checkbox.prop('checked')) {
                                    $submit.attr('disabled', false);
                                } else {
                                    $submit.attr('disabled', true);
                                }
                            });
                        });
                    </script>
                    <?
                }
                ?>

                <? // Captcha
                $frame = $this->createFrame()->begin('CAPTCHA');
                if ($arResult['USE_CAPTCHA'] == 'Y') { ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="captcha_word"><?= Loc::getMessage('BS_FIELD_CAPTCHA_3') ?> <span class="color-red">*</span></label>
                            <div class="form-group has-feedback">
                                <input id="captcha_word" class="form-control margin-bottom-20" type="password" name="captcha_word">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label><?= Loc::getMessage('BS_FIELD_CAPTCHA_1') ?></label>
                            <div class="captcha">
                                <input type="hidden" name="captcha_sid" value="<?= $arResult['CAPTCHA_CODE'] ?>"/>
                                <a href="" class="tooltips" data-toggle="tooltip" data-placement="top" data-original-title="<?= Loc::getMessage('BS_FIELD_CAPTCHA_2') ?>">
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA_CODE'] ?>" height="34" alt="CAPTCHA"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            // Reload Captcha
                            $('.captcha > a').click(function (e) {
                                e.preventDefault();
                                $.getJSON('<?= SITE_TEMPLATE_PATH?>/include/reload_captcha.php', function (data) {
                                    $('.captcha > a > img').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + data);
                                    $('.captcha > input').val(data);
                                });
                            });
                        });
                    </script>
                <? }
                $frame->end();
                ?>

                <hr>

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-6 text-right">
                        <button class="btn btn-u" type="submit"<? if ($useTerms) { ?> disabled="disabled"<? } ?>>
                            <?= Loc::getMessage('BS_FIELD_REGISTER') ?>
                        </button>
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
                                message: '<?= Loc::getMessage('BS_ERROR_LOGIN')?>'
                            },
                            stringLength: {
                                min: 3,
                                message: '<?= Loc::getMessage('BS_ERROR_LOGIN')?>'
                            }
                        }
                    },
                    USER_EMAIL: {
                        validators: {
                            notEmpty: {
                                message: '<?= Loc::getMessage('BS_ERROR_EMAIL')?>'
                            },
                            emailAddress: {
                                message: '<?= Loc::getMessage('BS_ERROR_EMAIL')?>'
                            }
                        }
                    },
                    USER_PASSWORD: {
                        validators: {
                            notEmpty: {
                                message: '<?= Loc::getMessage('BS_ERROR_PASSWORD')?>'
                            },
                            stringLength: {
                                min: 6,
                                message: '<?= Loc::getMessage('BS_ERROR_PASSWORD')?>'
                            }
                        }
                    },
                    USER_CONFIRM_PASSWORD: {
                        validators: {
                            notEmpty: {
                                message: '<?= Loc::getMessage('BS_ERROR_CONFIRM')?>'
                            },
                            identical: {
                                field: 'USER_PASSWORD',
                                message: '<?= Loc::getMessage('BS_ERROR_CONFIRM')?>'
                            }
                        }
                    },
                    captcha_word: {
                        validators: {
                            notEmpty: {
                                message: '<?= Loc::getMessage('BS_ERROR_CAPTCHA')?>'
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