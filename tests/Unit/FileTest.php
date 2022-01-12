<?php

namespace Tests\Unit;

use App\Packages\FileManager\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFile()
    {
        $path = __DIR__."/../FileTest/file1.txt";
        $file = new File($path);
        $this->assertFalse($file->isDir());
        $this->assertEquals($path, $file->getPath());
        $this->assertEquals([
            "path" => $path,
            "name" => null,
            "size" => null,
            "isDir" => false,
        ], $file->jsonSerialize());
    }

    public function testDir() {
        $path = __DIR__."/../FileTest/dir2";
        $file = new File($path);
        $this->assertTrue($file->isDir());
        $this->assertEquals($path, $file->getPath());
        $this->assertEquals([
            "path" => $path,
            "name" => null,
            "size" => null,
            "isDir" => true,
        ], $file->jsonSerialize());
    }
}
