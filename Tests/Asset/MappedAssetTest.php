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
use Phlexible\Component\Bundler\Asset\MappedAsset;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Phlexible\Component\Bundler\Asset\MappedAsset
 */
class MappedAssetTest extends TestCase
{
    public function testAsset()
    {
        $asset = new MappedAsset(__FILE__, __FILE__);

        $this->assertSame(__FILE__, $asset->getPathname());
        $this->assertInstanceof(Asset::class, $asset->getMapAsset());
        $this->assertSame(__FILE__, $asset->getMapAsset()->getPathname());
    }
}
