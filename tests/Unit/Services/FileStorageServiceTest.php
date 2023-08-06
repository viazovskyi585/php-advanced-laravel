<?php

namespace Tests\Unit\Services;

use App\Services\FileStorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageServiceTest extends TestCase
{
    public function test_store_file()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $filePath = FileStorageService::store($file, 'test');

        Storage::assertExists($filePath);
    }

    public function test_store_file_with_additional_path()
    {
        $file = UploadedFile::fake()->image('test.jpg');
        $additional_path = 'additional/path';

        $filePath = FileStorageService::store($file, $additional_path);

        $this->assertStringContainsString($additional_path, $filePath);
        Storage::assertExists($filePath);
    }

    public function test_delete_file()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $filePath = FileStorageService::store($file, 'test');

        FileStorageService::delete($filePath);

        Storage::assertMissing($filePath);
    }

    public function test_delete_directory()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $filePath = FileStorageService::store($file, 'test');

        FileStorageService::deleteDirectory('test');

        Storage::assertMissing($filePath);
    }
}
