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
use Phlexible\Component\Bundler\SourceMap\SourceMapBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\SourceMap\SourceMapBuilder
 */
class SourceMapBuilderTest extends TestCase
{
    public function testGetSourceMap()
    {
        $builder = new SourceMapBuilder('testFile', 0);
        $builder->add('testSource1', "line1\nline2\nline3");
        $builder->add('testSource2', "line4\nline5\nline6");
        $map = $builder->getSourceMap();

        $expected = new SourceMap(
            'testFile',
            '',
            array('testSource1', 'testSource2'),
            array("line1\nline2\nline3", "line4\nline5\nline6"),
            array(),
            'AAAA;AACA;AACA;ACFA;AACA;AACA;'
        );

        $this->assertEquals($expected, $map);
    }
}
