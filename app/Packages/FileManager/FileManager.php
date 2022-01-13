<?php

declare(strict_types=1);

namespace App\Packages\FileManager;

class FileManager
{
    protected string $path = "";

    /**
     * @var File[]
     */
    protected array $files = [];

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
//        $this->path = rtrim($path, "/");
        $this->path = $path;//rtrim($path, "/");
        $this->init();
    }
    
    protected function init() {
        $files = array_diff(scandir($this->path), ['.', '..']);

        sort($files, SORT_STRING);

        foreach ($files as $file) {
            $file = trim($file, "/");
            $this->files[$file] = new File($this->path."/".$file);
        }
    }

    public function list() {
        return $this->files;
    }

    public function create() {

    }

    public function update() {

    }

    /**
     * @throws NotFoundException
     */
    public function view($name) {
        // $name =>    public/dir1/dir2/dir3/dir4
        // $name =>    public/dir1/dir2/dir3/readme.txt
        // $files => [ public, dir1, dir2, dir3, readme.txt ]
        $files = explode("/", $name);
        $firstFileKey = array_shift($files);
        if (!array_key_exists($firstFileKey, $this->files)) {
            throw new NotFoundException("File `$name` not found!");
        }

        $firstFile = $this->files[$firstFileKey];

        if ($firstFile->isDir()) {
            $fm = new FileManager($firstFile->getPath());

            if (empty($files)) {
                return $fm->list();
            } else {
                return $fm->view(implode("/", $files));
            }
        }

        return file_get_contents($this->path."/".$name);
    }

    public function delete() {

    }
}
