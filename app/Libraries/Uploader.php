<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Models\Model;
use Illuminate\Http\File;
use League\Flysystem\Local\LocalFilesystemAdapter;

class Uploader
{
    private const DEFAULT_MAX_FILESIZE = 10_000_000;

    private string $ext;
    private ?string $filename;
    private string $srcPath;

    public function __construct(
        private string $baseDir,
        public Model $model,
        private string $attr,
        private array $processors = [],
    ) {
        $this->filename = $this->model->{$this->attr};
    }

    private static function process(string $name, ?array $options, string $srcPath): ?string
    {
        switch ($name) {
            case 'image':
                $processor = new ImageProcessor(
                    $srcPath,
                    $options['maxDimensions'],
                    $options['maxFilesize'] ?? static::DEFAULT_MAX_FILESIZE,
                );
                $processor->process();

                return $processor->ext();
        }

        throw new InvariantException('unknown process name');
    }

    public function delete(): void
    {
        $this->setFilename(null);
        \Storage::deleteDirectory($this->dir());
    }

    public function get(): ?string
    {
        $path = $this->path();

        return $path === null ? null : \Storage::get($path);
    }

    public function set(string $srcPath, string $ext = ''): void
    {
        $this->srcPath = $srcPath;
        $this->ext = $ext;

        foreach ($this->processors as $processName => $processOptions) {
            $newExt = static::process($processName, $processOptions, $this->srcPath);
            if ($newExt !== null) {
                $this->ext = $newExt;
            }
        }
    }

    public function store(string $srcPath, string $ext = ''): void
    {
        $this->set($srcPath, $ext);
        $this->updateFile();
    }

    public function updateFile(): void
    {
        if (!isset($this->ext, $this->srcPath)) {
            return;
        }

        $this->delete();
        $filename = hash_file('sha256', $this->srcPath);
        if (present($this->ext)) {
            $filename .= ".{$this->ext}";
        }
        $this->setFilename($filename);
        $storage = \Storage::disk();

        if ($storage->getAdapter() instanceof LocalFilesystemAdapter) {
            $options = [
                'visibility' => 'public',
                'directory_visibility' => 'public',
            ];
        }

        $storage->putFileAs(
            $this->dir(),
            new File($this->srcPath),
            $this->filename,
            $options ?? [],
        );
    }

    public function url(): ?string
    {
        $path = $this->path();

        return $path === null ? null : StorageUrl::make(null, $path);
    }

    private function dir(): string
    {
        return "{$this->baseDir}/{$this->model->getKey()}";
    }

    private function path(): ?string
    {
        return $this->filename === null ? null : "{$this->dir()}/{$this->filename}";
    }

    private function setFilename(?string $filename): void
    {
        $this->filename = $filename;
        $this->model->{$this->attr} = $filename;
    }
}
