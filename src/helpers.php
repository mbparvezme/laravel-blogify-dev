<?php

if (! function_exists('blogify_menu')) {
    /**
     * Generate the admin menu from the config file.
     *
     * @param bool $asArray
     * @param array $config
     * @return string|array
     */
    function blogify_menu(bool $asArray = false, array $config = [])
    {
        $menuItems = config('blogify.menu', []);

        if ($asArray) {
            return $menuItems;
        }

        $ulClass = $config['ul'] ?? '';
        $liClass = $config['li'] ?? '';
        $aClass = $config['a'] ?? '';

        $html = "<ul class=\"{$ulClass}\">";

        foreach ($menuItems as $item) {
            $link = route($item['route']);
            $name = $item['name'];
            $html .= "<li class=\"{$liClass}\"><a href=\"{$link}\" class=\"{$aClass}\">{$name}</a></li>";
        }

        $html .= '</ul>';

        return $html;
    }
}