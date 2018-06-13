<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
/** @global CMain $APPLICATION */
$APPLICATION->SetTitle('Главная');
global $mainPage;
?>

    <!-- Begin Slider -->
    <? $APPLICATION->IncludeComponent(
        'bitrix:news.list',
        'index.slider',
        array(
            'IBLOCK_TYPE'               => 'content',
            'IBLOCK_ID'                 => '7',
            'NEWS_COUNT'                => '10',
            'SORT_BY1'                  => 'SORT',
            'SORT_ORDER1'               => 'ASC',
            'FIELD_CODE'                => array(
                0 => 'DETAIL_PICTURE'
            ),
            'PROPERTY_CODE'             => array(
                0 => 'NO_SHADING',
                1 => 'SLIDE_VIEW',
                2 => 'SLIDE_NAME',
                3 => 'SLIDE_DESC',
                4 => 'BUTTON_1_TEXT',
                5 => 'BUTTON_1_LINK',
                6 => 'BUTTON_1_COLOR',
                7 => 'BUTTON_2_TEXT',
                8 => 'BUTTON_2_LINK',
                9 => 'BUTTON_2_COLOR',
            ),
            'SET_TITLE'                 => 'N',
            'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
            'ADD_SECTIONS_CHAIN'        => 'N',
            'CACHE_TYPE'                => 'A',
            'CACHE_TIME'                => '36000000',
        )
    ); ?>
    <!-- End Slider -->

    <div class="bg-grey">
        <div class="container content-sm">
            <!-- Service Blocks -->
            <? $APPLICATION->IncludeComponent(
                'bitrix:news.list',
                'index.services',
                array(
                    'IBLOCK_TYPE'               => 'content',
                    'IBLOCK_ID'                 => '13',
                    'NEWS_COUNT'                => '6',
                    'PREVIEW_TRUNCATE_LEN'      => '150',
                    'SORT_BY1'                  => 'SORT',
                    'SORT_ORDER1'               => 'ASC',
                    'FIELD_CODE'                => array(),
                    'PROPERTY_CODE'             => array(
                        0 => 'BLOCK_TEXT',
                        1 => 'BLOCK_LINK',
                        2 => 'BLOCK_ICON',
                        3 => 'BLOCK_COLOR',
                    ),
                    'SET_TITLE'                 => 'N',
                    'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                    'ADD_SECTIONS_CHAIN'        => 'N',
                    'CACHE_TYPE'                => 'A',
                    'CACHE_TIME'                => '36000000',
                    'CUSTOM_NAME'               => 'Наши услуги',
                )
            ); ?>
            <!-- End Service Blokcs -->
        </div>
    </div>

    <div class="purchase">
        <div class="container">
            <div class="row">
                <div class="col-md-9 animated fadeInLeft">
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:main.include',
                        '',
                        array(
                            'AREA_FILE_SHOW'   => 'sect',
                            'AREA_FILE_SUFFIX' => 'banner_1',
                        )
                    ); ?>
                </div>
                <div class="col-md-3 btn-buy animated fadeInRight">
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:main.include',
                        '',
                        array(
                            'AREA_FILE_SHOW'   => 'sect',
                            'AREA_FILE_SUFFIX' => 'banner_2',
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div><!--/row-->

    <div class="bg-grey">
        <div class="container content-sm">
            <div class="row equal-height-columns">
                <div class="col-md-6">
                    <!-- About Panel with Equal Height -->
                    <div class="panel panel-white equal-height-column no-margin-bottom">
                        <div class="panel-heading overflow-h">
                            <? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '',
                                array(
                                    'AREA_FILE_SHOW'   => 'sect',
                                    'AREA_FILE_SUFFIX' => 'about_1',
                                )
                            ); ?>
                        </div>
                        <div class="panel-body">
                            <? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '',
                                array(
                                    'AREA_FILE_SHOW'   => 'sect',
                                    'AREA_FILE_SUFFIX' => 'about_2',
                                )
                            ); ?>
                        </div>
                    </div>
                    <!-- End About Panel with Equal Height -->
                </div>

                <div class="col-md-6">
                    <? if ($mainPage == 'v1') {
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/index.news.php')) {
                            include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/index.news.php');
                        }
                    } elseif ($mainPage == 'v2') { ?>
                        <div class="panel panel-white equal-height-column no-margin-bottom">
                            <div class="panel-body">
                                <div class="responsive-video">
                                    <? $APPLICATION->IncludeComponent(
                                        'bitrix:main.include',
                                        '',
                                        array(
                                            'AREA_FILE_SHOW'   => 'sect',
                                            'AREA_FILE_SUFFIX' => 'video',
                                        )
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>

    <? // For Main Page 2.0 only
    if ($mainPage == 'v2') { ?>
        <!-- Parallax Counter -->
        <? $APPLICATION->IncludeComponent(
            'bitrix:news.list',
            'index.counters',
            array(
                'IBLOCK_TYPE'               => 'content',
                'IBLOCK_ID'                 => '11',
                'NEWS_COUNT'                => '4',
                'SORT_BY1'                  => 'SORT',
                'SORT_ORDER1'               => 'ASC',
                'FIELD_CODE'                => array(),
                'PROPERTY_CODE'             => array(
                    0 => 'COUNTER_ICON',
                    1 => 'COUNTER_NUMBER',
                ),
                'SET_TITLE'                 => 'N',
                'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                'ADD_SECTIONS_CHAIN'        => 'N',
                'CACHE_TYPE'                => 'A',
                'CACHE_TIME'                => '36000000',
            )
        ); ?>
        <!-- End Parallax Counter -->

        <div class="bg-grey">
            <div class="container content-sm">
                <div class="row equal-height-columns">
                    <div class="col-md-6">
                        <!-- Panel with Testimonials -->
                        <? $APPLICATION->IncludeComponent(
                            'bitrix:news.list',
                            'index.testimonials',
                            array(
                                'IBLOCK_TYPE'               => 'content',
                                'IBLOCK_ID'                 => '12',
                                'NEWS_COUNT'                => '10',
                                'PREVIEW_TRUNCATE_LEN'      => '200',
                                'SORT_BY1'                  => 'SORT',
                                'SORT_ORDER1'               => 'ASC',
                                'FIELD_CODE'                => array(),
                                'PROPERTY_CODE'             => array(
                                    0 => 'AUTHOR_POST',
                                    1 => 'AUTHOR_COMPANY',
                                ),
                                'SET_TITLE'                 => 'N',
                                'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                                'ADD_SECTIONS_CHAIN'        => 'N',
                                'CACHE_TYPE'                => 'A',
                                'CACHE_TIME'                => '36000000',
                                'CUSTOM_NAME'               => 'Отзывы клиентов',
                            )
                        ); ?>
                        <!-- End Panel with Testimonials -->
                    </div>

                    <div class="col-md-6">
                        <? if (file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/index.news.php')) {
                            include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/index.news.php');
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>

    <div class="container content-sm">
        <!-- Owl Clients v1 -->
        <? $APPLICATION->IncludeComponent(
            'bitrix:news.list',
            'index.clients-slider',
            array(
                'IBLOCK_TYPE'               => 'content',
                'IBLOCK_ID'                 => '10',
                'NEWS_COUNT'                => '20',
                'PREVIEW_TRUNCATE_LEN'      => '150',
                'SORT_BY1'                  => 'SORT',
                'SORT_ORDER1'               => 'ASC',
                'FIELD_CODE'                => array(),
                'PROPERTY_CODE'             => array(
                    0 => 'CLIENT_SITE',
                ),
                'SET_TITLE'                 => 'N',
                'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                'ADD_SECTIONS_CHAIN'        => 'N',
                'CACHE_TYPE'                => 'A',
                'CACHE_TIME'                => '36000000',
                'CUSTOM_NAME'               => 'Наши клиенты',
            )
        ); ?>
        <!-- End Owl Clients v1 -->
    </div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>