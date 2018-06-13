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

if (!empty($arResult['SLIDES'])) {
    ?>
    <div class="alpha-wrap">
        <div id="alpha-slider" class="flexslider alpha-slider" style="height: 500px;">
            <ul class="slides alpha-slides fill">
                <? // Slides
                foreach ($arResult['SLIDES'] as $arSlide) {
                    $shading = ' shading';
                    if ($arSlide['NO_SHADING'] == 'Y') {
                        $shading = '';
                    }
                    ?>
                    <li class="fill<?= $shading ?>" style="background-image: url('<?= $arSlide['BACKGROUND'] ?>');">
                        <? // Slide has info (text or image)
                        if (isset($arSlide['AREAS']) && is_array($arSlide['AREAS'])) {
                            ?>
                            <div class="container fill">
                                <div class="alpha-caption fill">
                                    <? // Info Areas
                                    foreach ($arSlide['AREAS'] as $areaType => $arArea) {
                                        // Image Area
                                        if ($areaType == 'IMAGE') {
                                            ?>
                                            <div class="col-md-6 hidden-xs hidden-sm fill">
                                                <div class="caption caption-image vertical-align fill">
                                                    <div>
                                                        <img src="<?= $arArea['SRC'] ?>" alt="" draggable="false">
                                                    </div>
                                                </div>
                                            </div>
                                            <?
                                        }
                                        // Text Area
                                        elseif ($areaType == 'TEXT') {
                                            $areaCols = 6;
                                            if (count($arSlide['AREAS']) == 1) {
                                                $areaCols = 12;
                                            }
                                            ?>
                                            <div class="col-md-<?= $areaCols ?> fill">
                                                <div class="caption caption-text vertical-align fill text-center">
                                                    <div>
                                                        <div class="alpha-ch1"><?= $arArea['NAME'] ?></div>
                                                        <div class="alpha-ch2">
                                                            <div><?= $arArea['DESC'] ?></div>
                                                        </div>
                                                        <? // Buttons
                                                        if (is_array($arArea['BUTTONS']) && isset($arArea['BUTTONS'])) {
                                                            ?>
                                                            <div class="alpha-ch3">
                                                                <? foreach ($arArea['BUTTONS'] as $arButton) {
                                                                    $modalAttr = '';
                                                                    if ($arButton['MODAL_TRIGGER'] == 'Y') {
                                                                        $modalAttr = ' data-toggle="modal" data-target="#alpha-modal"';
                                                                    }
                                                                    ?>
                                                                    <a href="<?= $arButton['LINK'] ?>" class="btn-u<?= $arButton['COLOR'] ?>"<?= $modalAttr ?>>
                                                                        <?= $arButton['TITLE'] ?>
                                                                    </a>
                                                                <? } ?>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <? } ?>
                    </li>
                <? } ?>
            </ul>
        </div>
        <div class="alpha-nav hidden-xs">
            <a href="" class="flex-prev"><i class="fa fa-angle-left"></i></a>
            <div class="alpha-bullets"></div>
            <a href="" class="flex-next"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
    <?
}