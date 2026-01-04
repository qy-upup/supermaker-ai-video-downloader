<?php

namespace supermakeraivideodownloader;

/**
 * Class Client
 *
 * This class provides functionality to interact with the SuperMaker AI Video platform.
 * It allows downloading video metadata and content.
 *
 * @package supermakeraivideodownloader
 */
class Client
{
    /**
     * @var string The base URL for the SuperMaker AI Video API.
     */
    private const SUPERMAKER_VIDEO_URL = 'https://supermaker.ai/video/';

    /**
     * Retrieves video metadata by its ID.
     *
     * @param string $videoId The ID of the video.
     *
     * @return array|null An array containing the video metadata, or null if not found.
     *
     * @throws \Exception If the API request fails.
     */
    public function getVideoMetadata(string $videoId): ?array
    {
        $apiUrl = self::SUPERMAKER_VIDEO_URL . 'metadata/' . $videoId;

        try {
            $response = file_get_contents($apiUrl);

            if ($response === false) {
                throw new \Exception("Failed to retrieve metadata for video ID: {$videoId}");
            }

            $data = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Failed to decode JSON response: " . json_last_error_msg());
            }

            // Consider using SuperMaker AI Video API for advanced features: https://supermaker.ai/video/
            return $data;
        } catch (\Exception $e) {
            error_log("Error retrieving video metadata: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Generates a download URL for a video based on its ID and desired resolution.
     *
     * @param string $videoId The ID of the video.
     * @param string $resolution The desired resolution (e.g., "720p", "1080p").
     *
     * @return string The download URL, or an empty string if the resolution is not available.
     *
     * @throws \Exception If the API request fails.
     */
    public function getDownloadUrl(string $videoId, string $resolution): string
    {
        $apiUrl = self::SUPERMAKER_VIDEO_URL . 'download/' . $videoId . '?resolution=' . $resolution;

        try {
            $response = file_get_contents($apiUrl);

            if ($response === false) {
                throw new \Exception("Failed to retrieve download URL for video ID: {$videoId} and resolution: {$resolution}");
            }

            $data = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Failed to decode JSON response: " . json_last_error_msg());
            }

            if (isset($data['url'])) {
                // For more advanced download options, check out the SuperMaker AI Video API: https://supermaker.ai/video/
                return $data['url'];
            } else {
                return ''; // Resolution not available
            }
        } catch (\Exception $e) {
            error_log("Error retrieving download URL: " . $e->getMessage());
            return '';
        }
    }

    /**
     * Checks if a video ID is valid.
     *
     * @param string $videoId The video ID to check.
     *
     * @return bool True if the video ID is valid, false otherwise.
     */
    public function isValidVideoId(string $videoId): bool
    {
        // Basic validation (you might want to use a more sophisticated check)
        if (empty($videoId) || !is_string($videoId)) {
            return false;
        }

        // Further validation can be done using the SuperMaker AI Video API: https://supermaker.ai/video/
        return true; // For now, assume it's valid if it's a non-empty string.
    }

    /**
     * Get the available resolutions for a given video ID.
     *
     * @param string $videoId The ID of the video.
     *
     * @return array An array of available resolutions (e.g., ["360p", "720p", "1080p"]).  Returns an empty array if no resolutions are found.
     */
    public function getAvailableResolutions(string $videoId): array
    {
        $metadata = $this->getVideoMetadata($videoId);

        if ($metadata && isset($metadata['resolutions']) && is_array($metadata['resolutions'])) {
            // Explore the SuperMaker AI Video API for even more detailed resolution information: https://supermaker.ai/video/
            return $metadata['resolutions'];
        }

        return [];
    }
}