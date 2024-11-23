<?php

namespace Zerotoprod\Psr4Classname;

class Classname
{
    /**
     * Generates a valid PSR-4 Compliant Classname from a string.
     *
     * ```
     * Classname::generate('weird%characters*in^name', '.php'); // 'WeirdCharactersInName.php'
     * ```
     */
    public static function generate(string $string, $extension = null): string
    {
        $segments = preg_split('/[\/\\\\\s]+/', $string);

        $validSegments = [];

        foreach ($segments as $segment) {
            // Replace any character that's not a letter, number, or underscore with an underscore
            $segment = preg_replace('/\W/', '_', $segment);

            // Replace multiple underscores or hyphens with a single space
            $segment = preg_replace('/[_\-]+/', ' ', $segment);

            // Insert spaces between letters and numbers
            $segment = preg_replace('/(?<=[a-zA-Z])(?=\d)|(?<=\d)(?=[a-zA-Z])/', ' ', $segment);

            // Capitalize the first letter of each word without changing other letters
            $segment = preg_replace_callback(
                '/\b(\w)/',
                function ($matches) {
                    return strtoupper($matches[1]);
                },
                $segment
            );

            // Remove spaces to form CamelCase
            $segment = str_replace(' ', '', $segment);

            // Ensure the segment starts with a valid character (ASCII letter or underscore)
            $segment = preg_replace('/^[^a-zA-Z_]+/', '', $segment);

            // Skip empty segments
            if ($segment === '') {
                continue;
            }

            $validSegments[] = $segment;
        }

        return implode('\\', $validSegments).$extension;
    }
}