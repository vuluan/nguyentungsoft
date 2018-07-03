<?php
/**
 * Shortcut wrapper for image resizing on the fly
 *
 * Usage:
 *
 *   {{ image|resize(width, height, mode, position, quality) }}
 *
 *  e.g.
 *
 *   {{ image|resize(800, 600) }}
 *   {{ image|resize(320, null, {mode: 'crop'}) }}
 *   {{ image|resize(null, 1080, {mode: 'crop', position: 'top-left', quality: 80}) }}
 *
 *   {{ image|media() }}
 *   <img src="http://domain.com/img/image.jpg" width="[original width]" height="[original height]" alt="image alt tag">
 *
 *   {{ image|media(1440, 700, { attr: { class: 'img-responsive mb3', 'data-name': 'value' } }) }}
 *   <img src="http://domain.com/img/_1440x700_crop_center-center_80/image.jpg" width="1440" height="700" alt="image alt tag" class="img-responsive mb3", data-name="value">
 */

namespace Base\AdminBundle\Twig;

use Symfony\Component\Asset\Packages;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ImageHelperExtension
 * @package Shopmacher\Schuhmarke\FrontendBundle\Twig
 */
class ImageHelperExtension extends \Twig_Extension
{
    // resizing modes
    const MODE_CROP    = 'crop';
    const MODE_FIT     = 'fit';
    const MODE_STRETCH = 'stretch';
    // cropping positions
    const POSITION_TOP_LEFT      = 'top-left';
    const POSITION_TOP_CENTER    = 'top-center';
    const POSITION_TOP_RIGHT     = 'top-right';
    const POSITION_CENTER_LEFT   = 'center-left';
    const POSITION_CENTER_CENTER = 'center-center';
    const POSITION_CENTER_RIGHT  = 'center-right';
    const POSITION_BOTTOM_LEFT   = 'bottom-left';
    const POSITION_BOTTOM_CENTER = 'bottom-center';
    const POSITION_BOTTOM_RIGHT  = 'bottom-right';
    /**
     * @return string
     */
    public function getName()
    {
        return 'ImageHelper';
    }
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            'resize' => new \Twig_Filter_Method($this, 'resize', [
                'is_safe' => ['html']
            ]),
            'media' => new \Twig_Filter_Method($this, 'media', [
                'is_safe' => ['html']
            ])
        ];
    }
    /**
     * Return the url of the (resized) asset
     *
     * @param AssetFileModel $file
     * @param int|null $width
     * @param int|null $height
     * @param array $options
     * @return string
     */
    public function resize(AssetFileModel $file = null, $width = null, $height = null, $options = [])
    {
        if (!$file instanceof AssetFileModel) {
            return '';
        }
        $transform = $this->transform($file, $width, $height, $options);
        return $file->getUrl($transform);
    }
    /**
     * Create a complete <img> element from the (resized) asset
     *
     * @param AssetFileModel $file
     * @param null $width
     * @param null $height
     * @param array $options
     * @return mixed todo - add srcset attributes for hi-res displays
     *
     * todo - add srcset attributes for hi-res displays
     * @internal param int|null $width
     * @internal param int|null $height
     */
    public function media(AssetFileModel $file = null, $width = null, $height = null, $options = [])
    {
        if (!$file instanceof AssetFileModel) {
            return '';
        }
        $attributes = '';
        if (isset($options['attr'])) {
            $attributes = implode(' ', array_map(
                function ($v, $k) { return sprintf('%s="%s"', $k, $v); },
                $options['attr'],
                array_keys($options['attr'])
            ));
        }
        // no resize, return original
        if (is_int($width) || is_int($height)) {
            $transform = $this->transform($file, $width, $height, $options);
            $file->setTransform($transform);
        }
        $img = '<img src="' . $file->getUrl() . '" width="' . $file->getWidth() . '" height="' . $file->getHeight() . '" alt="' . HtmlHelper::encode($file->title) . '" ' . $attributes . ' />';
        return TemplateHelper::getRaw($img);
    }
    /**
     * @param AssetFileModel $file
     * @param $width
     * @param $height
     * @param $options
     * @return array|null|\Twig_Markup
     */
    private function transform(AssetFileModel $file, $width, $height, $options)
    {
        $mode     = isset($options['mode'])     ? $options['mode']     : self::MODE_CROP;
        $position = isset($options['position']) ? $options['position'] : self::POSITION_CENTER_CENTER;
        $quality  = isset($options['quality'])  ? $options['quality']  : 90;
        list($width, $height) = ImageHelper::calculateMissingDimension($width, $height, $file->getWidth(), $file->getHeight());
        $transform = [
            'mode'     => $this->mode($mode),
            'width'    => $width,
            'height'   => $height,
            'quality'  => (int)$quality
        ];
        if ($mode == self::MODE_CROP) {
            $transform['position'] = $this->position($position);
        }
        return $transform;
    }
    /**
     * Validate resize mode
     *
     * @param $mode
     * @return mixed
     * @throws \InvalidArgumentException
     */
    private function mode($mode)
    {
        if (!in_array($mode, [
            self::MODE_CROP,
            self::MODE_FIT,
            self::MODE_STRETCH
        ])) {
            throw new \InvalidArgumentException('Invalid resize mode: '.(string)$mode);
        }
        return $mode;
    }
    /**
     * Validate crop position
     *
     * @param $position
     * @return mixed
     * @throws \InvalidArgumentException
     */
    private function position($position)
    {
        if (!in_array($position, [
            self::POSITION_TOP_LEFT,
            self::POSITION_TOP_CENTER,
            self::POSITION_TOP_RIGHT,
            self::POSITION_CENTER_LEFT,
            self::POSITION_CENTER_CENTER,
            self::POSITION_CENTER_RIGHT,
            self::POSITION_BOTTOM_LEFT,
            self::POSITION_BOTTOM_CENTER,
            self::POSITION_BOTTOM_RIGHT
        ])) {
            throw new \InvalidArgumentException('Invalid crop position: '.(string)$position);
        }
        return $position;
    }
}
