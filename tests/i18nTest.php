<?php

namespace rockunit;

use rock\i18n\i18n;

class i18nTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $i18n = new i18n();
        $i18n->locale('test')->category('lang');
        $i18n->add('foo.bar', 'text {{placeholder}}');
        $this->assertSame(
            [
                'lang' =>
                    [
                        'foo' =>
                            [
                                'bar' => 'text {{placeholder}}',
                            ],
                    ],
            ],
            $i18n->getAll()
        );
        $this->assertTrue($i18n->exists('foo.bar'));

        $this->assertSame('text', $i18n->translate('foo.bar'));

        // placeholder
        $this->assertSame('text baz', $i18n->translate('foo.bar', ['placeholder' => 'baz']));

        // not replace placeholder
        $this->assertSame('text {{placeholder}}', $i18n->removeBraces(false)->translate('foo.bar'));
    }

    public function testRemove()
    {
        $i18n = new i18n();
        $i18n->locale('test')->category('lang');
        $i18n->addMulti([
            'test' => [
                'lang' => [
                    'foo' => [
                        'bar' => 'text'
                    ]
                ]
            ]
        ]);
        $i18n->remove('foo.bar');
        $this->assertSame(
            [
                'lang' => [
                        'foo' =>[],
                    ],
            ],
            $i18n->getAll()
        );
        $i18n->remove('foo');
        $this->assertSame(
            [
                'lang' => [],
            ],
            $i18n->getAll()
        );
        $this->assertFalse($i18n->exists('foo.bar'));
    }

    /**
     * @expectedException \rock\i18n\i18nException
     */
    public function testUnknownThrowException()
    {
        $i18n = new i18n();
        $i18n->locale('en')->category('lang');
        $i18n->translate('foo.bar');
    }

    public function testUnknownWithoutThrowException()
    {
        $i18n = new i18n();
        $i18n->throwException = false;
        $i18n->locale('en')->category('lang');
        $this->assertNull($i18n->translate('foo.bar'));
    }

    public function testAddDicts()
    {
        (new i18n)->clear();
        $i18n = new i18n(['pathsDicts' => [
            'ru' => [
                ROCKUNIT . '/data/lang/ru/lang.php',
            ],
            'en' => [
                ROCKUNIT . '/data/lang/en/lang.php',
            ]
        ]]);

        $this->assertSame('Hello world!', $i18n->translate('hello'));
        $this->assertSame('Привет мир!', i18n::t('hello', [], null, 'ru'));
    }

    /**
     * @depends testAddDicts
     */
    public function testClearAndExists()
    {
        $i18n = new i18n();
        $this->assertNotEmpty($i18n->getAll());
        $this->assertTrue($i18n->exists('hello'));
        $i18n->clear();

        $this->assertEmpty($i18n->getAll());
        $this->assertFalse($i18n->exists('hello'));
    }
}