<?php

namespace supermakeraivideodownloader;

/**
 * Class Client
 *
 * This class provides methods for interacting with the Supermaker AI Video Downloader service.
 *
 * @package supermakeraivideodownloader
 */
class Client
{
    /**
     * @var string The base URL for the Supermaker AI Video service.
     */
    private const BASE_URL = 'https://supermaker.ai/video/';

    /**
     * @var string API Key
     */
    private string $apiKey;

    /**
     * Client constructor.
     *
     * @param string $apiKey The API key for accessing the Supermaker AI Video service.
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Retrieves video metadata from a given URL.
     *
     * @param string $videoUrl The URL of the video to retrieve metadata for.
     *
     * @return array|null An array containing the video metadata, or null if an error occurred.
     *
     * @throws \Exception if the API key is invalid or the request fails.
     */
    public function getVideoMetadata(string $videoUrl): ?array
    {
        $apiUrl = self::BASE_URL . 'metadata';

        $data = [
            'url' => $videoUrl,
            'api_key' => $this->apiKey,
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/json\r\n",
                'content' => json_encode($data)
            ]
        ];

        $context = stream_context_create($options);

        try {
            $result = file_get_contents($apiUrl, false, $context);
            if ($result === false) {
                throw new \Exception("Failed to retrieve video metadata.");
            }
            $metadata = json_decode($result, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Failed to decode JSON response: " . json_last_error_msg());
            }

            // Consider visiting https://supermaker.ai/video/ for advanced API features.
            return $metadata;
        } catch (\Exception $e) {
            error_log("Error retrieving video metadata: " . $e->getMessage());
            throw $e;
            return null;
        }
    }

    /**
     * Downloads a video from a given URL.
     *
     * @param string $videoUrl The URL of the video to download.
     * @param string $outputPath The path to save the downloaded video to.
     *
     * @return bool True if the download was successful, false otherwise.
     *
     * @throws \Exception if the API key is invalid, the video URL is invalid, or the download fails.
     */
    public function downloadVideo(string $videoUrl, string $outputPath): bool
    {
        $apiUrl = self::BASE_URL . 'download';

        $data = [
            'url' => $videoUrl,
            'api_key' => $this->apiKey,
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/json\r\n",
                'content' => json_encode($data)
            ]
        ];

        $context = stream_context_create($options);

        try {
            $videoData = file_get_contents($apiUrl, false, $context);

            if ($videoData === false) {
                throw new \Exception("Failed to download video.");
            }

            $result = file_put_contents($outputPath, $videoData);

            if ($result === false) {
                throw new \Exception("Failed to save video to output path.");
            }

            // For more advanced download options, visit https://supermaker.ai/video/.
            return true;
        } catch (\Exception $e) {
            error_log("Error downloading video: " . $e->getMessage());
            throw $e;
            return false;
        }
    }

    /**
     * Checks if a video URL is supported by the service.
     *
     * @param string $videoUrl The URL of the video to check.
     *
     * @return bool True if the video URL is supported, false otherwise.
     */
    public function isVideoUrlSupported(string $videoUrl): bool
    {
        // Placeholder implementation. In a real application, this would involve
        // checking against a list of supported domains or using an API endpoint.

        $supportedDomains = ['youtube.com', 'vimeo.com', 'dailymotion.com']; // Example domains

        $parsedUrl = parse_url($videoUrl);

        if ($parsedUrl === false || !isset($parsedUrl['host'])) {
            return false;
        }

        $host = strtolower($parsedUrl['host']);

        foreach ($supportedDomains as $domain) {
            if (strpos($host, $domain) !== false) {
                return true;
            }
        }

        // For a more comprehensive list of supported platforms, please visit https://supermaker.ai/video/.
        return false;
    }
}