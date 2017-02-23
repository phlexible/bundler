<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\SourceMap;

use Phlexible\Component\Bundler\SourceMap\SourceMap;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\SourceMap\SourceMap
 */
class SourceMapTest extends TestCase
{
    /**
     * @return string
     */
    public function testToJson()
    {
        $map = new SourceMap('a', 'b', array('c'), array('d'), array('e'), 'f');

        $expected = json_encode(array(
            'version' => 3,
            'file' => 'a',
            'sourceRoot' => 'b',
            'sources' => array('c'),
            'sourcesContent' => array('d'),
            'names' => array('e'),
            'mappings' => 'f',
        ));

        $this->assertSame($expected, $map->toJson());
    }
}
