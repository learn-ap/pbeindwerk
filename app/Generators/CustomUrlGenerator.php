<?php

namespace App\Generators;

use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;
use Spatie\MediaLibrary\Support\UrlGenerator\UrlGenerator;


class CustomUrlGenerator extends BaseUrlGenerator implements UrlGenerator
{
    public function getUrl(): string
    {
        $url = config('app.url') . '/storage/' . $this->getPathRelativeToRoot();
        return $url;
    }

    public function getPath(): string
    {
        return $this->getPathRelativeToRoot();
    }

    public function getTemporaryUrl(\DateTimeInterface $expiration, array $options = []): string
    {
        return $this->getUrl();
    }

    public function getResponsiveImagesDirectoryUrl(): string
    {
        return $this->getUrl() . '/responsive-images/';
    }
}

