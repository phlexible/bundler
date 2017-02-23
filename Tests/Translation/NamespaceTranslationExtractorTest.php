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

use Phlexible\Component\Bundler\Translation\NamespaceTranslationExtractor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\MessageCatalogue;

/**
 * @covers \Phlexible\Component\Bundler\Translation\NamespaceTranslationExtractor
 */
class NamespaceTranslationExtractorTest extends TestCase
{
    public function testExtract()
    {
        $messageCatalog = new MessageCatalogue('de', array('testDomain' => array('foo.bar' => 'baz', 'lorem.ipsum.dolor.sit' => 'amet')));

        $extractor = new NamespaceTranslationExtractor();
        $result = $extractor->extract($messageCatalog, 'testDomain');

        $expected = array(
            'foo' => array('bar' => 'baz'),
            'lorem' => array('ipsum' => array('dolor' => array('sit' => 'amet'))),
        );

        $this->assertEquals($expected, $result);
    }
}
