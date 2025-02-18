<?php

namespace Zerotoprod\Psr4Classname;

/**
 * @link https://github.com/zero-to-prod/psr4-classname
 */
class Classname
{
    /**
     * Generates a valid PSR-4 Compliant Classname from a string.
     *
     * ```
     * Classname::generate('weird%characters*in^name', '.php'); // 'WeirdCharactersInName.php'
     * ```
     *
     * @link https://github.com/zero-to-prod/psr4-classname
     */
    public static function generate(string $string, $extension = null): string
    {
        // Split on backslash only, so forward slashes stay within the same segment
        $segments = preg_split('/\\\\+/', $string);

        $validSegments = [];

        foreach ($segments as $segment) {
            // Replace forward slash with space, so "some/random" stays one segment => "some random"
            $segment = str_replace('/', ' ', $segment);

            // Replace any non-alphanumeric/underscore character with underscore
            $segment = preg_replace('/\W/', '_', $segment);

            // Replace runs of underscores or hyphens with a single space
            $segment = preg_replace('/[_\-]+/', ' ', $segment);

            // Insert spaces between letters and numbers (e.g. "class123name" => "class 123 name")
            $segment = preg_replace('/(?<=[a-zA-Z])(?=\d)|(?<=\d)(?=[a-zA-Z])/', ' ', $segment);

            // Capitalize the first letter of each word without lowercasing the others
            $segment = preg_replace_callback(
                '/\b(\w)/',
                function ($matches) {
                    return strtoupper($matches[1]);
                },
                $segment
            );

            // Remove all spaces to get a CamelCase segment
            $segment = str_replace(' ', '', $segment);

            // Ensure segment starts with a valid character (letter or underscore).
            // Leading digits or leftover symbols are stripped out.
            $segment = preg_replace('/^[^a-zA-Z_]+/', '', $segment);

            // Skip if the result is empty after cleanup
            if ($segment === '') {
                continue;
            }

            $validSegments[] = $segment;
        }

        return implode('\\', $validSegments).$extension;
    }
}