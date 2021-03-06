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
use Phlexible\Component\Bundler\Compressor\SimpleCssCompressor;
use PHPUnit\Framework\TestCase;

/**
 * Simple css compressor test.
 *
 * @author Stephan Wentz <sw@brainbits.net>
 *
 * @covers \Phlexible\Component\Bundler\Compressor\SimpleCssCompressor
 */
class SimpleCssCompressorTest extends TestCase
{
    /**
     * @var SimpleCssCompressor
     */
    private $compressor;

    protected function setUp()
    {
        $this->compressor = new SimpleCssCompressor();
    }

    private function createCss()
    {
        return <<<'EOF'
#some.test {
    background-color: #FFFFFF;
    /* test */
}
EOF;
    }

    public function testCompressString()
    {
        $css = $this->createCss();

        $this->assertEquals('#some.test{background-color: #FFFFFF}', $this->compressor->compressString($css));
    }

    public function testCompressStream()
    {
        $css = $this->createCss();

        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $css);
        rewind($stream);

        $compressed = stream_get_contents($this->compressor->compressStream($stream));

        $this->assertEquals('#some.test{background-color: #FFFFFF}', $compressed);
    }

    public function testCompressFile()
    {
        $css = $this->createCss();

        vfsStream::setup('root', null, array('test.css' => $css));

        $compressed = file_get_contents($this->compressor->compressFile(vfsStream::url('root/test.css')));

        $this->assertEquals('#some.test{background-color: #FFFFFF}', $compressed);
    }
}
