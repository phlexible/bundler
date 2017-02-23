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

use Phlexible\Component\Bundler\SourceMap\Mapping;
use Phlexible\Component\Bundler\SourceMap\SourceMapIndex;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\SourceMap\SourceMapIndex
 */
class SourceMapIndexTest extends TestCase
{
    /**
     * @var SourceMapIndex
     */
    private $index;

    protected function setUp()
    {
        $this->index = new SourceMapIndex('testSource', "line1\nline2\nline3");
    }

    public function testGetSource()
    {
        $this->assertSame('testSource', $this->index->getSource());
    }

    public function testGetContent()
    {
        $this->assertSame("line1\nline2\nline3", $this->index->getContent());
    }

    public function testGetMappings()
    {
        $mappings = $this->index->getMappings(5, 17);

        $expected = array(
            new Mapping(17, 0, 5, 0, 0),
            new Mapping(18, 0, 5, 1, 0),
            new Mapping(19, 0, 5, 2, 0),
        );

        $this->assertEquals($expected, $mappings);
    }
}
