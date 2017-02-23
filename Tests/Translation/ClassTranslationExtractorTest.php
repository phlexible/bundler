<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\Translation;

use Phlexible\Component\Bundler\Translation\ClassTranslationExtractor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\MessageCatalogue;

/**
 * @covers \Phlexible\Component\Bundler\Translation\ClassTranslationExtractor
 */
class ClassTranslationExtractorTest extends TestCase
{
    public function testExtract()
    {
        $messageCatalog = new MessageCatalogue('de', array('testDomain' => array('Phlexible.user.MainView.title' => 'Users', 'Phlexible.user.UserWindow.user' => 'User')));

        $extractor = new ClassTranslationExtractor();
        $result = $extractor->extract($messageCatalog, 'testDomain');

        $expected = array(
            'Phlexible.user.MainView' => array('title' => 'Users'),
            'Phlexible.user.UserWindow' => array('user' => 'User'),
        );

        $this->assertEquals($expected, $result);
    }
}
