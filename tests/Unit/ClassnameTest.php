<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\Psr4Classname\Classname;

class ClassnameTest extends TestCase
{
    /**
     * @test
     * @dataProvider classNameProvider
     */
    public function generate($input, $expected): void
    {
        $this->assertEquals($expected, Classname::generate($input));
    }

    public static function classNameProvider(): array
    {
        return [
            ["my awesome class", "MyAwesomeClass"],
            ["123 invalid class", "InvalidClass"],
            ["some/random\\path", "SomeRandom\\Path"],
            ["weird%characters*in^name", "WeirdCharactersInName"],
            ["my_class_name", "MyClassName"],
            ["!@#$%^&*()", ""],
            ["", ""],
            ["  multiple   spaces  ", "MultipleSpaces"],
            ["_private_class", "PrivateClass"],
            ["namespace\\\\class", "Namespace\\Class"],
            ["class123name", "Class123Name"],
            ["mix_of-different/separators\\here", "MixOfDifferentSeparators\\Here"],
            ["fooBarBaz", "FooBarBaz"],
            ["foo123bar456", "Foo123Bar456"],
            ["userID", "UserID"],
            ["123numberStart", "NumberStart"],
            ["special—char", "SpecialChar"],
            ["emoji😊test", "EmojiTest"],
            ["汉字漢字", ""],
        ];
    }

    /** @test */
    public function extension(): void
    {
        $this->assertEquals(
            'User.php',
            Classname::generate('User', '.php')
        );
    }
}