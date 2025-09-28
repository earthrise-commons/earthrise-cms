<?php

use Kirby\Cms\App;
// plugin to safely resize images and return null if the image is missing (for optional image fields)
App::plugin('earthrise/safe-resize', [
  'fileMethods' => [
    /**
     * @kql-allowed
     */
    'safeResize' => function (int $width = 1200, int $height = null, array $options = []) {
      if (!$this) {
        return null; // field empty -> return null
      }

      $thumb = $this->resize($width, $height, $options);

      if (!$thumb) {
        return null; // resize failed -> return null
      }

      return [
        'url'    => $thumb->url(),
        'width'  => $thumb->width(),
        'height' => $thumb->height(),
        'alt'    => $this->alt()->or(''),
      ];
    }
  ]
]);
