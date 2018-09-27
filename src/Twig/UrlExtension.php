<?php
namespace App\Twig;

use App\Utils\AwsS3Client;

class UrlExtension extends \Twig_Extension implements \Twig_ExtensionInterface
{
    /** @var AwsS3Client */
    private $awsS3Client;

    public function __construct(AwsS3Client $awsS3Client)
    {
        $this->awsS3Client = $awsS3Client;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('cdn_url', [$this, 'getCdnUrl'])
        ];
    }

    public function getCdnUrl(?string $path): string
    {
        return $this->awsS3Client->getImageCdn() . DIRECTORY_SEPARATOR . $path;
    }
}
