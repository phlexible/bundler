<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\MappedContent;

use Phlexible\Component\Bundler\Content\MappedContent;

/**
 * @covers \Phlexible\Component\Bundler\MappedContent\MappedContent
 */
class MappedContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return string
     */
    public function testMappedContent()
    {
        $mappedContent = new MappedContent('foo', 'bar');

        $this->assertSame('foo', $mappedContent->getContent());
        $this->assertSame('bar', $mappedContent->getMap());
    }
}
