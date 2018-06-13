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

?>
<form id="feedForm" class="contact-form margin-top-20" action="<?= POST_FORM_ACTION_URI ?>" method="post" role="form">
    <input id="sessid_form" type="hidden" value="" name="sessid">
    <script>
        BX.ready(function() {
            BX('sessid_form').value = BX.bitrix_sessid();
        });
    </script>
    <? // Message Block
    if (strlen($arResult['OK_MESSAGE']) > 0 || !empty($arResult['ERROR_MESSAGE'])) {
        $alertClass = 'alert alert-success';
        $alertMessage = $arResult['OK_MESSAGE'];
        if (!empty($arResult['ERROR_MESSAGE'])) {
            $alertClass = 'alert alert-danger';
            $alertMessage = '';
            foreach ($arResult['ERROR_MESSAGE'] as $message) {
                $alertMessage .= '<small class="help-block">' . $message . '</small>';
            }
        }
        ?>
        <div id="messBlockFeed" class="<?= $alertClass ?>"><?= $alertMessage ?></div>
    <? } else { ?>
        <div id="messBlockFeed" class="alert alert-danger hidden"></div>
    <? } ?>

    <div class="row">
        <div class="col-md-6">
            <div>
                <label for="name">
                    <?= Loc::getMessage('BS_FIELD_NAME') ?>
                    <?  // Validators
                    $bvString = ' ';
                    if(empty($arParams['REQUIRED_FIELDS']) || in_array('NAME', $arParams['REQUIRED_FIELDS'])) {
                        ?><span class="color-red">*</span><?
                        $bvString .= 'data-bv-notempty="true" data-bv-notempty-message="' . Loc::getMessage('BS_ERROR_NAME') . '"';
                    } ?>
                </label>
                <div id="name-frame" class="form-group has-feedback">
                    <? $frame = $this->createFrame('name-frame', false)->begin() ?>
                        <input id="name" class="form-control margin-bottom-20" type="text" name="user_name" value="<?= $arResult['AUTHOR_NAME'] ?>"<?= $bvString ?>/>
                    <? $frame->beginStub() ?>
                        <input id="name" class="form-control margin-bottom-20" type="text" name="user_name" value=""<?= $bvString ?>/>
                    <? $frame->end() ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div>
                <label for="email">
                    <?= Loc::getMessage('BS_FIELD_EMAIL') ?>
                    <? // Validators
                    $bvString = ' data-bv-emailaddress="true" data-bv-emailaddress-message="' . Loc::getMessage('BS_ERROR_EMAIL') . '"';
                    if(empty($arParams['REQUIRED_FIELDS']) || in_array('EMAIL', $arParams['REQUIRED_FIELDS'])) {
                        ?><span class="color-red">*</span><?
                        $bvString .= 'data-bv-notempty="true" data-bv-notempty-message="' . Loc::getMessage('BS_ERROR_EMAIL') . '"';
                    } ?>
                </label>
                <div id="email-frame" class="form-group has-feedback">
                    <? $frame = $this->createFrame('email-frame', false)->begin() ?>
                        <input id="email" class="form-control margin-bottom-20" type="text" name="user_email" value="<?= $arResult['AUTHOR_EMAIL'] ?>"<?= $bvString ?>/>
                    <? $frame->beginStub() ?>
                        <input id="email" class="form-control margin-bottom-20" type="text" name="user_email" value=""<?= $bvString ?>/>
                    <? $frame->end() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div>
                <label for="message">
                    <?= Loc::getMessage('BS_FIELD_MESSAGE') ?>
                    <? // Validators
                    $bvString = ' ';
                    if(empty($arParams['REQUIRED_FIELDS']) || in_array('MESSAGE', $arParams['REQUIRED_FIELDS'])) {
                        ?><span class="color-red">*</span><?
                        $bvString .= 'data-bv-notempty="true" data-bv-notempty-message="' . Loc::getMessage('BS_ERROR_MESSAGE') . '"';
                    } ?>
                </label>
                <div id="message-frame" class="form-group has-feedback">
                    <? $frame = $this->createFrame('message-frame', false)->begin() ?>
                        <textarea id="message" class="form-control resize-vertical margin-bottom-20" name="MESSAGE" rows="8"<?= $bvString ?>><?= $arResult['MESSAGE'] ?></textarea>
                    <? $frame->beginStub() ?>
                        <textarea id="message" class="form-control resize-vertical margin-bottom-20" name="MESSAGE" rows="8"<?= $bvString ?>></textarea>
                    <? $frame->end() ?>
                </div>
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
                        <input type="checkbox" name="USER_TERMS" data-bv-notempty="true" data-bv-notempty-message="<?=Loc::getMessage('BS_ERROR_REQ', array('#FIELD_NAME#' =>  Loc::getMessage('BS_CONFIRM_TITLE_1').Loc::getMessage('BS_CONFIRM_TITLE_2')))?>">
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
    if ($arParams['USE_CAPTCHA'] == 'Y') {
        $bvString = ' data-bv-notempty="true" data-bv-notempty-message="' . Loc::getMessage('BS_ERROR_CAPTCHA') . '"';
        ?>
        <div class="row">
            <div class="col-sm-3">
                <label><?= Loc::getMessage('BS_FIELD_CAPTCHA_1') ?></label>
                <div class="captcha">
                    <input type="hidden" name="captcha_sid" value="<?= $arResult['capCode'] ?>"/>
                    <a href="" class="tooltips" data-toggle="tooltip" data-placement="top" data-original-title="<?= Loc::getMessage('BS_FIELD_CAPTCHA_2') ?>">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['capCode'] ?>" height="34" alt="CAPTCHA"/>
                    </a>
                </div>
            </div>
            <div class="col-sm-9">
                <label for="captcha_word">
                    <?= Loc::getMessage('BS_FIELD_CAPTCHA_3') ?>
                    <span class="color-red">*</span>
                </label>
                <div class="form-group has-feedback">
                    <input id="captcha_word" class="form-control margin-bottom-20" type="text" name="captcha_word"<?= $bvString ?>/>
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

    <div class="row">
        <div class="col-lg-6 col-lg-offset-6 text-right">
            <button class="btn btn-u" type="submit" name="submit_form" value="Y"<? if ($useTerms) { ?> disabled="disabled"<? } ?>>
                <?= Loc::getMessage('BS_FIELD_SUBMIT') ?>
            </button>
            <input type="hidden" name="PARAMS_HASH" value="<?= $arResult['PARAMS_HASH'] ?>">
        </div>
    </div>
</form>

<script>
    $(function () {
        var $messBlockFeed = $('#messBlockFeed');
        $('#feedForm').bootstrapValidator({
            container: '#messBlockFeed',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            live: 'enabled'
        }).on('error.field.bv', function () {
            // Show Message Block if has errors
            $messBlockFeed.removeClass('hidden');
        }).on('status.field.bv', function(e, data) {
            // Hide Message Block if has no errors
            /*if (data.bv.getInvalidFields().length == 0) {
                $messBlockFeed.addClass('hidden');
            }*/ 
            if ($messBlockFeed.find('.help-block:visible').length <= 0) {
                $messBlockFeed.addClass('hidden');
            }
        });
    });
</script>