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

use Phlexible\Component\Bundler\Content\ResourceContent;
use Symfony\Component\Config\Resource\FileResource;

/**
 * @covers \Phlexible\Component\Bundler\Content\ResourceContent
 */
class ResourceContentTest extends \PHPUnit_Framework_TestCase
{
    public function testMappedContent()
    {
        $resource = new FileResource(__FILE__);

        $mappedContent = new ResourceContent('foo', array($resource));

        $this->assertSame('foo', $mappedContent->getContent());
        $this->assertSame(array($resource), $mappedContent->getResources());
    }
}
