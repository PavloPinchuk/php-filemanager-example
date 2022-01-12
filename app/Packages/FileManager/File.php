<?php

declare(strict_types=1);

namespace App\Packages\FileManager;

class File implements \JsonSerializable
{
    protected $path;
    protected $name;
    protected $size;
    protected bool $isDir = false;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->isDir = is_dir($this->path);
    }

    public function getPath() {
        return $this->path;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function isDir():bool {
        return $this->isDir;
    }
}
