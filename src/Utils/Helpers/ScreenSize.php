<?php
namespace App\Utils\Helpers;

/**
 * Class ScreenSize
 *
 * @package App\Utils\Helpers
 */
class ScreenSize
{
    const EXTRA_SMALL = 'xs';
    const SMALL = 'sm';
    const MEDIUM = 'md';
    const LARGE = 'lg';
    const EXTRA_LARGE = 'xl';

    public static $minWidth = [
        self::EXTRA_SMALL => null,
        self::SMALL       => '576',
        self::MEDIUM      => '768',
        self::LARGE       => '992',
        self::EXTRA_LARGE => '1200',
    ];

    protected $size;

    /**
     * ScreenSize constructor.
     *
     * @param string $size
     */
    public function __construct($size)
    {
        if (!in_array($size, [
            self::EXTRA_SMALL,
            self::SMALL,
            self::MEDIUM,
            self::LARGE,
            self::EXTRA_LARGE,
        ])) {
            throw new \InvalidArgumentException('size is not valid');
        }

        $this->size = $size;
    }

    public function isDefault(): bool
    {
        return $this->size === self::EXTRA_SMALL;
    }

    public function isOriginal(): bool
    {
        return $this->size === self::EXTRA_LARGE;
    }

    public function getResponsiveFilename(string $originalFileName): string
    {
        if (!$this->isOriginal()) {
            return substr_replace($originalFileName, '--' . $this->size, strrpos($originalFileName, '.'), 0);
        }

        return $originalFileName;
    }

    public function __toString(): string
    {
        return $this->size;
    }
}
