<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\Asset;

use Phlexible\Component\Bundler\Asset\Asset;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\Asset\Asset
 */
class AssetTest extends TestCase
{
    public function testAsset()
    {
        $asset = new Asset('foo');

        $this->assertSame('foo', $asset->getFile());
    }
}
