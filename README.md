# supermaker-ai-video-downloader

A Python library for programmatically downloading videos from the [Supermaker AI Video platform](https://supermaker.ai/video/).

## Installation

To install `supermaker-ai-video-downloader`, use pip:
bash
pip install supermaker-ai-video-downloader

Alternatively, you can clone the repository and install it locally:
bash
git clone https://github.com/your-username/supermaker-ai-video-downloader.git
cd supermaker-ai-video-downloader
pip install .

## Core API/Feature Overview

This library provides a simple and efficient way to interact with the Supermaker AI Video platform and download videos. Key features include:

1.  **Asynchronous Downloading:**  Leverages `asyncio` for efficient, non-blocking video downloads. This allows for concurrent downloads and improved performance.

2.  **Progress Tracking:** Provides callbacks for monitoring download progress, including percentage completed and download speed.  This allows you to provide real-time feedback to the user.

3.  **Adaptive Streaming Support:**  Handles adaptive bitrate streaming (ABS) formats, automatically selecting the optimal video quality based on network conditions.

4.  **Error Handling:** Robust error handling with specific exception types for common issues such as network errors, invalid URLs, and authentication failures.

5.  **Authentication Support:** Securely authenticates with the [Supermaker AI Video platform](https://supermaker.ai/video/) using API keys or other authentication methods.

## Usage Examples

**Basic Download:**
python
import asyncio
from supermaker_ai_video_downloader import Downloader

async def main():
    downloader = Downloader(api_key="YOUR_API_KEY") # Replace with your actual API key
    video_url = "YOUR_VIDEO_URL" # Replace with the URL of the Supermaker AI video
    output_path = "downloaded_video.mp4"

    await downloader.download(video_url, output_path)
    print(f"Video downloaded to {output_path}")

if __name__ == "__main__":
    asyncio.run(main())

**Download with Progress Tracking:**
python
import asyncio
from supermaker_ai_video_downloader import Downloader

async def main():
    async def progress_callback(percentage, speed):
        print(f"Download Progress: {percentage:.2f}%, Speed: {speed:.2f} MB/s")

    downloader = Downloader(api_key="YOUR_API_KEY")
    video_url = "YOUR_VIDEO_URL"
    output_path = "downloaded_video.mp4"

    await downloader.download(video_url, output_path, progress_callback=progress_callback)
    print(f"Video downloaded to {output_path}")

if __name__ == "__main__":
    asyncio.run(main())

## Enterprise Solutions

For advanced features, including bulk downloading, custom configurations, and dedicated support, explore the [Supermaker AI Video platform](https://supermaker.ai/video/) for enterprise solutions. This platform offers a comprehensive suite of tools for managing and distributing your video content.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.