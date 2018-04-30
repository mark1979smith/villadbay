<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 23/01/2018
 * Time: 14:59
 */

namespace App\Utils;


use App\Component\ImageTypes;
use Aws\S3\S3Client;

class AwsS3Client
{
    use ImageTypes;

    /** @var  string */
    protected $version;

    /** @var  string */
    protected $region;

    /** @var  string */
    protected $bucket;

    /** @var string */
    protected $imageCdn;

    /** @var Redis|null */
    protected $cache;

    public function __construct($version, $region, $bucket, $imageCdn, $cacheHandler = null)
    {
        $this->setVersion($version);
        $this->setRegion($region);
        $this->setBucket($bucket);
        $this->setImageCdn($imageCdn);
        if (!is_null($cacheHandler)) {
            $this->setCache($cacheHandler);
        }
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

    /**
     * @return \App\Utils\Redis
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param mixed $cache
     *
     * @return AwsS3Client
     */
    public function setCache($cache)
    {
        $this->cache = $cache;

        return $this;
    }

    public function getImagesBasedOnConfig(array $config)
    {
        $cacheKey = 'aws.s3.listobjects.' . $this->getBucket() . '-' . md5(serialize($config));
        if ($this->getCache()->get()->hasItem($cacheKey)) {
            /** \Aws\Result $results */
            $results = $this->getCache()->get()->getItem($cacheKey)->get();
            return $results;
        } else {
            $s3Client = $this->get();

            $isTruncated = false;
            $page = 1;
            $awsListingData = [];
            $orderByAssetName = [];
            $orderByAssetType = [];
            // Build up the assets list available on AWS S3
            do {
                $response = $s3Client->listObjectsV2($config);
                if ($response instanceof \Aws\Result) {
                    $isTruncated = $response->get('IsTruncated');
                    if (is_iterable($response->get('Contents'))) {
                        foreach ($response->get('Contents') as $key => $asset) {
                            // Only return assets which are lowercase
                            if (strcmp($asset['Key'], strtolower($asset['Key'])) === 0) {
                                $headers = $s3Client->headObject(['Bucket' => $this->getBucket(), 'Key' => $asset['Key']]);
                                $awsListingData[$key] = array_merge($asset, ['DisplayKey' => basename($asset['Key']), 'Metadata' => $headers->get('Metadata')]);
                                if (isset($headers->get('Metadata')['filename'])) {
                                    // This is the uploaded image
                                    $orderByAssetName[$key] = $asset['Key'];
                                    $orderByAssetType[$key] = 1;
                                } else if (isset($headers->get('Metadata')['parent'])) {
                                    // This is the resized image
                                    $orderByAssetName[$key] = $headers->get('Metadata')['parent'];
                                    if (strpos($asset['Key'], '--xs.')) {
                                        $orderByAssetType[$key] = 2;
                                    } else if (strpos($asset['Key'], '--sm.')) {
                                        $orderByAssetType[$key] = 3;
                                    } else if (strpos($asset['Key'], '--md.')) {
                                        $orderByAssetType[$key] = 4;
                                    } else if (strpos($asset['Key'], '--lg.')) {
                                        $orderByAssetType[$key] = 5;
                                    }
                                }
                            }
                        }
                    }
                }

                if ($isTruncated) {
                    $config['ContinuationToken'] = $response->get('NextContinuationToken');
                } else {
                    unset($config['ContinuationToken']);
                }

                $page++;
            } while ($isTruncated === true);

            array_multisort($orderByAssetName, SORT_ASC, $orderByAssetType, SORT_ASC, $awsListingData);

            $cacheItem = $this->getCache()->get()->getItem($cacheKey);
            $cacheItem->set($awsListingData);
            $this->getCache()->get()->save($cacheItem);

            return $awsListingData;
        }
    }

}
