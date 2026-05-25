<?php
namespace Tuanbtre\Csm\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class UploadService
{
    public static function upload(
        ?UploadedFile $file,
        string $folder = 'uploads'
    ): ?string {
        try {
            if (!$file || !$file->isValid()) {
                throw new \Exception('Upload failed');
            }
            // mime cho phép
            $allowed = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/webp',
                'image/gif',
                'image/bmp',
                'image/svg+xml',
                'image/avif',
            ];
            if (!in_array($file->getMimeType(), $allowed)) {
                throw new \Exception('Invalid image type');
            }
            // tên file
            $filename = uniqid() . '.webp';
            $path = $folder . '/' . $filename;
            // xử lý ảnh
            $image = Image::read($file)
                ->orient()
                ->toWebp(80);
            // lưu storage/app/images
            Storage::disk('images')->put(
                $path,
                (string) $image
            );
            // trả về url
            return $filename;
        } catch (\Throwable $e) {
            Log::error('Upload image error', [
                'message' => $e->getMessage(),
                'file' => $file?->getClientOriginalName(),
                'folder' => $folder,
            ]);
            return null;
        }
    }
    public static function delete(
        ?string $filename,
        string $folder = 'uploads'
    ): bool {
        try {
            if (!$filename) {
                return false;
            }
            $path = trim($folder, '/')
                . '/'
                . ltrim($filename, '/');
            if (Storage::disk('images')->exists($path)) {
                Storage::disk('images')->delete($path);
                return true;
            }
            return false;
        } catch (\Throwable $e) {
            Log::error('Delete image error', [
                'message' => $e->getMessage(),
                'filename' => $filename,
                'folder' => $folder,
            ]);
            return false;
        }
    }
}    
?>