<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
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
?>
<ul class="nav navbar-nav">
    <li>
        <i class="search fa fa-search search-btn"></i>

        <div class="search-open">
            <form action="<?= $arResult['FORM_ACTION'] ?>">
                <div class="input-group animated fadeInDown">
                    <input type="text" name="q" class="form-control" placeholder="<?= GetMessage('ALPHA_SEARCH_TITLE'); ?>">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit" name="s">
                            <?= GetMessage('ALPHA_SEARCH_BUTTON'); ?>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </li>
</ul>