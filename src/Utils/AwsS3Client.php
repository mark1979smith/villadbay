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
    const CACHE_TAG_ASSET_LIST = 'asset-listing';
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

    protected $profiles = array();

    /**
     * AwsS3Client constructor.
     *
     * @param string                $version
     * @param string                $region
     * @param string                $bucket
     * @param string                $imageCdn
     * @param \App\Utils\Redis|null $cacheHandler
     */
    public function __construct(string $version, string $region, string $bucket, string $imageCdn, ?\App\Utils\Redis $cacheHandler = null)
    {
        $this->setVersion($version);
        $this->setRegion($region);
        $this->setBucket($bucket);
        $this->setImageCdn($imageCdn);
        if (!is_null($cacheHandler)) {
            $this->setCache($cacheHandler);
        }
    }

    /**
     * @return \Aws\S3\S3Client
     */
    private function get()
    {
        $this->profiles[] = ['_method' => __METHOD__];
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

    public function getImagesBasedOnConfig(array $config = []): array
    {
        if (!isset($config['Bucket'])) {
            $config['Bucket'] = $this->getBucket();
        }
        if (!isset($config['Prefix'])) {
            $config['Prefix'] = 'images/';
        }
        $cacheKey = 'aws.s3.listobjects.' . $this->getBucket() . '-' . md5(serialize($config));
        if ($this->getCache()->hasItem($cacheKey)) {
            /** array $results */
            $results = $this->getCache()->getItem($cacheKey)->get();
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
                $this->profiles[] = array_merge(['_method' => __METHOD__ . ' listObjectsV2'], $config);
                if ($response instanceof \Aws\Result) {
                    $isTruncated = $response->get('IsTruncated');
                    if (is_iterable($response->get('Contents'))) {
                        foreach ($response->get('Contents') as $key => $asset) {
                            // Only return assets which are lowercase
                            if (strcmp($asset['Key'], strtolower($asset['Key'])) === 0) {
                                $headData = ['Bucket' => $this->getBucket(), 'Key' => $asset['Key']];
                                $this->profiles[] = array_merge(['_method' => __METHOD__ . ' headObject'], $headData);
                                $headers = $s3Client->headObject($headData);

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
                                } else {
                                    // Skip assets without these metadata fields
                                    continue;
                                }
                                $awsListingData[$key] = array_merge($asset, [
                                    'CdnUrl' => $this->getImageCdn() . DIRECTORY_SEPARATOR . $asset['Key'],
                                    'DisplayKey' => basename($asset['Key']),
                                    'Metadata' => $headers->get('Metadata')
                                ]);
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

            $cacheItem = $this->getCache()->getItem($cacheKey);
            $cacheItem->set($awsListingData);
            $cacheItem->tag(self::CACHE_TAG_ASSET_LIST);
            $this->getCache()->save($cacheItem);

            return $awsListingData;
        }
    }

    public function deleteImages($hash)
    {
        $coreData = [
            'Prefix'     => $hash,
            'Bucket'     => $this->getBucket(),
            'MaxKeys'    => 1000,
        ];

        $response = $this->get()->listObjectsV2($coreData);
        $this->profiles[] = array_merge(['_method' => __METHOD__ . ' listObjectsV2'], $coreData);
        if ($response->hasKey('Contents') && is_iterable($response->get('Contents'))) {
            $data = [
                'Bucket' => $this->getBucket(),
                'Delete' => [
                    'Objects' => array_map(function ($asset) {
                        return ['Key' => $asset['Key']];
                    }, $response->get('Contents')),
                ],
            ];
            $this->profiles[] = array_merge(['_method' => __METHOD__ . ' deleteObjects'], $data);
            $this->get()->deleteObjects($data);
        }

        $this->getCache()->invalidateTag(self::CACHE_TAG_ASSET_LIST);
    }

    /**
     * @param array $config
     *
     * @return \Aws\Result
     */
    public function putObject(array $config)
    {
        $this->profiles[] = ['_method' => __METHOD__, 'Key' => $config['Key']];

        return $this->get()->putObject($config);
    }

    /**
     * @return array
     */
    public function getProfiles(): array
    {
        return $this->profiles;
    }



}
