# SuperMaker AI Video Downloader (PHP)

Build tagged links and embeddable HTML that point to https://supermaker.ai/video/.

## Install

```bash
composer require supermaker/ai-video-downloader
```

## Usage

```php
<?php
require 'vendor/autoload.php';

use SuperMaker\AiVideoDownloader\Backlinks;

$url = Backlinks::buildLink([
    'utm_source' => 'blog',
    'utm_medium' => 'banner',
    'utm_campaign' => 'video',
    // default path is /video/, override if needed:
    // 'path' => Backlinks::defaultPath(),
]);

$html = Backlinks::generateAnchor([
    'text' => 'SuperMaker AI Video Downloader',
    'rel' => 'sponsored noopener',
    'utm' => ['utm_source' => 'blog'],
]);
```

## API
- `Backlinks::buildLink(array $options = [])` → URL string. Supports `utm_source`, `utm_medium`, `utm_campaign`, `path` (default `/video/`).
- `Backlinks::generateAnchor(array $options = [])` → HTML `<a>`. Supports `text`, `rel`, `target`, `class`, `utm`, `path`.
- `Backlinks::defaultPath()` => `/video/`.

## Develop / Test

```bash
composer install
composer test
```
