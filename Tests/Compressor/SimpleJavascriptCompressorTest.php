<?php

/*
 * This file is part of the phlexible bundler package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Component\Bundler\Tests\Compressor;

use org\bovigo\vfs\vfsStream;
use Phlexible\Component\Bundler\Compressor\SimpleJavascriptCompressor;
use PHPUnit\Framework\TestCase;

/**
 * Simple Javascript compressor test.
 *
 * @author Stephan Wentz <sw@brainbits.net>
 *
 * @covers \Phlexible\Component\Bundler\Compressor\SimpleJavascriptCompressor
 */
class SimpleJavascriptCompressorTest extends TestCase
{
    /**
     * @var SimpleJavascriptCompressor
     */
    private $compressor;

    protected function setUp()
    {
        $this->compressor = new SimpleJavascriptCompressor();
    }

    private function createJs()
    {
        return <<<'EOF'
var x = {
    test: 1,
    bla: 2,
    blubb: 3
};
EOF;
    }

    public function testCompressString()
    {
        $js = $this->createJs();

        $compressed = $this->compressor->compressString($js);

        $this->assertEquals($this->createJs(), $compressed);
    }

    public function testCompressStream()
    {
        $js = $this->createJs();

        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $js);
        rewind($stream);

        $compressed = stream_get_contents($this->compressor->compressStream($stream));

        $this->assertEquals($this->createJs(), $compressed);
    }

    public function testCompressFile()
    {
        $js = $this->createJs();

        vfsStream::setup('root', null, array('test.js' => $js));

        $compressed = file_get_contents($this->compressor->compressFile(vfsStream::url('root/test.js')));

        $this->assertEquals($this->createJs(), $compressed);
    }
}
