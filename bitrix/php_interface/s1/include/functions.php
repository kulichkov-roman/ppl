<?php
/**
 * Вывод данных в отформатированном виде
 * @param $var      - данные для вывода
 * @param bool $die - прерывать выполнение скриптов
 * @param bool $all - отображать всем пользователям
 */
if (!function_exists('pre')) {
    function pre($var, $die = false, $all = false)
    {
        global $USER;

        if ($USER->IsAdmin() || $all == true) {
            ?>
            <pre><? print_r($var) ?></pre><?
        }
        if ($die) {
            die;
        }
    }
}

/**
 * Получение символьного кода цвета по его ID
 * @param $colorId     - id цвета
 * @return bool|string - символьный код цвета
 */
if (!function_exists('getColorCode')) {
    function getColorCode($colorId)
    {
        $colorCode = false;

        if ($colorId > 0) {
            $rsColor = CIBlockElement::GetList(array(), array('IBLOCK_ID' => IBLOCK_COLORS, 'ID' => $colorId), false, false, array('NAME', 'CODE'));
            if ($arColor = $rsColor->GetNext(true, false)) {
                $colorCode = ToLower($arColor['CODE']);
            }
        }

        return $colorCode;
    }
}

/**
 * Получение полного пути для левого сайдбара
 * @param string $path - раздел, для которого нужно найти сайдбар (по умолчанию - текущий раздел)
 * @return string      - полный путь до файла сайдбара
 */
if (!function_exists('getLeftSidebar')) {
    function getLeftSidebar($path = '')
    {
        global $APPLICATION;

        $path = rtrim($path, '/');
        if (!$path) {
            $path = $APPLICATION->GetCurDir();
        }

        $result = '';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path . '/.sidebar.left.php')) {
            $result = $_SERVER['DOCUMENT_ROOT'] . $path . '/.sidebar.left.php';
        } else {
            $parent = dirname($path);
            if ($parent != '/' && $parent != '\\') {
                $result = getLeftSidebar($parent);
            }
        }

        return $result;
    }
}

/**
 * Проверка нахождения в одном из указанных разделов. Раздел сайта подставляется автматически.
 * @param $arDir - массив разделов для проверки
 * @return bool  - вернет true, если находимся хотя бы в одном из проверяемых разделов
 */
if (!function_exists('inDir')) {
    function inDir($arDir)
    {
        $result = false;
        if ($arDir && is_array($arDir)) {
            foreach ($arDir as $dir) {
                if (CSite::InDir(rtrim(SITE_DIR, '/') . $dir)) {
                    $result = true;
                    break;
                }
            }
        }

        return $result;
    }
}

if (!function_exists('getIconClass')) {
    function getIconClass($icon)
    {
        $icon = ToLower(trim($icon));

        $itemIcon = '';
        // Clear points in icon class
        $itemIconClass = str_replace('.', '', $icon);
        if (strlen($itemIconClass) > 0) {
            $tmpIcon = explode('-', $itemIconClass);
            if (in_array($tmpIcon[0], array('fa', 'glyphicon'))) {
                $itemIcon = $tmpIcon[0] . ' ';
            }

            $itemIcon .= $itemIconClass;
        }

        return $itemIcon;
    }
}