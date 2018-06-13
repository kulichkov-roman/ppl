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

$maskPattern = Option::get(BS_MODULE_ID, 'maskPattern', '+7(999)999-99-99');
$useTerms = $arParams['BS_DISABLE_CONFIRM'] != 'Y';

if (strlen($arResult['MESSAGE']) > 0) {
    ?>
    <div class="modal-header">
        <h4 class="modal-title text-center" id="modal-label"><?= ShowNote($arResult['MESSAGE']) ?></h4>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <button type="button" class="btn-u btn-block" data-dismiss="modal"><?= Loc::getMessage('BS_CLOSE_TITLE') ?></button>
            </div>
        </div>
    </div>
    <?
} else {
    ?>
    <form id="callForm" class="modal-form" action="<?= POST_FORM_ACTION_URI ?>" method="post">
        <?= bitrix_sessid_post() ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-times"></i>
            </button>
            <h4 class="modal-title"><?= Loc::getMessage('BS_MODAL_TITLE') ?></h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <? if (!empty($arResult['ERRORS'])) { ?>
                        <div id="messBlockModal" class="alert alert-danger"><?= implode('<br />', $arResult['ERRORS']) ?></div>
                    <? } else { ?>
                        <div id="messBlockModal" class="alert alert-danger hidden"></div>
                    <? } ?>
                </div>

                <? foreach ($arResult['FORM_FIELDS'] as $propId => $arField) {
                    // Fields Count
                    if ($arField['MULTIPLE'] == 'Y') {
                        $inputNum = count($arResult['ERRORS']) > 0 ? count($arResult['ELEMENT_PROPERTIES'][$propId]) : 0;
                        $inputNum += $arField['MULTIPLE_CNT'];
                    } else {
                        $inputNum = 1;
                    }

                    // Title
                    $fieldTitle = '';
                    if (!empty($arField['NAME'])) {
                        $fieldTitle = $arField['NAME'];
                    }

                    // Validation
                    $validator = '';
                    if ($arField['IS_REQUIRED'] == 'Y') {
                        $validator .= ' data-bv-notempty="true"';
                        $validator .= ' data-bv-notempty-message="' . Loc::getMessage('BS_ERROR_REQUIRED', array('#FIELD_NAME#' => $arField['NAME'])) . '"';
                    }
                    if ($arField['CODE'] == 'USER_PHONE') {
                        $validator .= ' data-bv-phone="true"';
                        $validator .= ' data-bv-phone-country="RU"';
                        $validator .= ' data-bv-phone-message="' . Loc::getMessage('BS_ERROR_PHONE') . '"';
                    }
                    if ($arField['CODE'] == 'USER_EMAIL') {
                        $validator .= ' data-bv-emailaddress="true"';
                        $validator .= ' data-bv-emailaddress-message="' . Loc::getMessage('BS_ERROR_EMAIL') . '"';
                    }

                    ?>
                    <div class="col-md-12">
                        <div>
                            <?
                            // Title
                            if (strlen($fieldTitle) > 0) { ?>
                                <label for="PROPERTY_<?= $propId ?>">
                                    <?= $fieldTitle ?>
                                    <? if ($arField['IS_REQUIRED'] == 'Y') { ?>
                                        <span class="color-red">*</span>
                                    <? } ?>
                                </label>
                                <?
                            }
                            // For multiple
                            for ($i = 0; $i < $inputNum; $i++) {
                                $value = $arField['DEFAULT_VALUE'];
                                if (!empty($arResult['ERRORS'])) {
                                    $value = $arResult['ELEMENT_PROPERTIES'][$propId][$i];
                                }
                                // String Fields
                                if ($arField['CUSTOM_TYPE'] == 'string') {
                                    ?>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="<?= ToLower($arField['CODE'])?> form-control margin-bottom-20" name="PROPERTY[<?= $propId ?>][<?= $i ?>]" id="PROPERTY_<?= $propId ?>" value="<?= $value ?>"<?= $validator ?>/>
                                    </div>
                                    <?
                                }
                                // Text Fields
                                if ($arField['CUSTOM_TYPE'] == 'text') {
                                    if (is_array($value) && isset($value['TEXT'])) {
                                        $value = $value['TEXT'];
                                    }
                                    ?>
                                    <div class="form-group has-feedback">
                                        <textarea class=" <?= ToLower($arField['CODE'])?> form-control no-resize margin-bottom-20" name="PROPERTY[<?= $propId ?>][<?= $i ?>]" id="PROPERTY_<?= $propId ?>" rows="3"<?= $validator ?>><?= $value ?></textarea>
                                    </div>
                                    <?
                                }
                            } ?>
                        </div>
                    </div>
                    <?
                }

                // Personal Data
                if ($useTerms)
                {
                    $termsLink = SITE_DIR . ltrim(Option::get(BS_MODULE_ID, 'termsLink'), '/');
                    ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="terms-block">
                                <input type="checkbox" name="USER_TERMS" data-bv-notempty="true" data-bv-notempty-message="<?=Loc::getMessage('BS_ERROR_REQUIRED', array('#FIELD_NAME#' =>  Loc::getMessage('BS_CONFIRM_TITLE_1').Loc::getMessage('BS_CONFIRM_TITLE_2')))?>">
                                <span><?= Loc::getMessage('BS_CONFIRM_TITLE_1') ?><? if (strlen($termsLink) > 0) { ?><a href="<?= $termsLink ?>" target="_blank"><?= Loc::getMessage('BS_CONFIRM_TITLE_2') ?></a><? } else { ?><?= Loc::getMessage('BS_CONFIRM_TITLE_2') ?><? } ?></span>
                            </label>
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

                // Captcha
                if ($arParams['USE_CAPTCHA'] == 'Y') {
                    // Validation
                    $validator = ' data-bv-notempty="true"';
                    $validator .= ' data-bv-notempty-message="' . Loc::getMessage('BS_ERROR_CAPTCHA') . '"';
                    ?>
                    <div class="col-md-4">
                        <div>
                            <label><?= Loc::getMessage('BS_CAPTCHA_1') ?></label>
                            <div class="form-group has-feedback text-left captcha">
                                <a href="" class="tooltips" data-toggle="tooltip" data-placement="top" data-original-title="<?= Loc::getMessage('BS_CAPTCHA_2') ?>">
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA_CODE'] ?>" height="34" alt="CAPTCHA"/>
                                </a>
                                <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div>
                            <label for="capcha_word">
                                <?= Loc::getMessage('BS_CAPTCHA_3') ?>
                                <span class="color-red">*</span>
                            </label>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control margin-bottom-20" name="captcha_word" id="capcha_word" value=""<?= $validator ?>>
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
                    <?
                } else { ?>
                    <div class="col-md-12 hidden">
                        <div>
                            <label for="alternate"></label>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" name="alternate" id="alternate" value="">
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8">
                            <button type="submit" class="btn btn-u btn-block" name="submit_form" value="Y"<? if ($useTerms) { ?> disabled="disabled"<? } ?>>
                                <?= Loc::getMessage('BS_SEND_TITLE') ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult['PARAMS_HASH'] ?>"/>
    </form>
    <script>
        $(function () {
            var $messBlockModal = $('#messBlockModal');
            $('#callForm').bootstrapValidator({
                container: '#messBlockModal',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                }
            }).on('error.field.bv', function () {
                // Show Message Block if has errors
                $messBlockModal.removeClass('hidden');
            }).on('success.field.bv', function () {
                // Hide Message Block if has no errors
                if ($messBlockModal.find('.help-block:visible').length <= 0) {
                    $messBlockModal.addClass('hidden');
                }
            });
            $(".user_phone").inputmask("<?= $maskPattern ?>");
        });
    </script>
    <?
}