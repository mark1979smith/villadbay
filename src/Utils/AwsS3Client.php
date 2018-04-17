<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 14:59
 */

namespace App\Utils;


use Aws\S3\S3Client;

class AwsS3Client
{
    /** @var  string */
    protected $version;

    /** @var  string */
    protected $region;

    /** @var  string */
    protected $bucket;

    /** @var string */
    protected $imageCdn;

    public function __construct($version, $region, $bucket, $imageCdn)
    {
        $this->setVersion($version);
        $this->setRegion($region);
        $this->setBucket($bucket);
        $this->setImageCdn($imageCdn);
    }

    public function get()
    {
        $s3 = new S3Client([
            'version' => $this->getVersion(),
            'region'  => $this->getRegion()
        ]);

        return $s3;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return \App\Utils\AwsS3Client
     */
    public function setVersion(string $version): AwsS3Client
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     *
     * @return S3Client
     */
    public function setRegion(string $region): AwsS3Client
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * @param string $bucket
     *
     * @return S3Client
     */
    public function setBucket(string $bucket): AwsS3Client
    {
        $this->bucket = $bucket;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageCdn(): string
    {
        return $this->imageCdn;
    }

    /**
     * @param string $imageCdn
     *
     * @return AwsS3Client
     */
    public function setImageCdn(string $imageCdn): AwsS3Client
    {
        $this->imageCdn = $imageCdn;

        return $this;
    }

}
