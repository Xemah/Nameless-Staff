<?php

class Staff {
    private static Language $_language;

    public static function getLanguage(string $file, string $term, array $variables = []): string
    {
        if (!isset(self::$_language)) {
            self::$_language = new Language(ROOT_PATH . '/modules/Staff/language', LANGUAGE);
        }
        return self::$_language->get($file, $term, $variables);
    }
}