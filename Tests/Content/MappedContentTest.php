<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\Content;

use Phlexible\Component\Bundler\Content\MappedContent;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\Content\MappedContent
 */
class MappedContentTest extends TestCase
{
    public function testMappedContent()
    {
        $mappedContent = new MappedContent('foo', 'bar');

        $this->assertSame('foo', $mappedContent->getContent());
        $this->assertSame('bar', $mappedContent->getMap());
    }
}
