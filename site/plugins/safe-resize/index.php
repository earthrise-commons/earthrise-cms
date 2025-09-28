<?php

use Kirby\Cms\App;
// plugin to safely resize images and return null if the image is missing (for optional image fields)
App::plugin('earthrise/safe-resize', [
  'fieldMethods' => [
    /**
     * @kql-allowed
     */
    'safeResize' => function ($field, $width = 1200) {
      if (!$field) {
        return null; // field empty -> return null
      }

      if (!$field->toFile()) {
        return null; // not a file -> return null
      }

      $thumb = $field->toFile()->resize($width);

      if (!$thumb) {
        return null; // resize failed -> return null
      }

      return [
        'url'    => $thumb->url(),
        'width'  => $thumb->width(),
        'height' => $thumb->height(),
      ];
    }
  ]
]);
