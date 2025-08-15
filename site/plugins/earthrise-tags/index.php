<?php
// TODO: rewrite this plugin, currently written with AI as proof of concept
Kirby::plugin('earthrise/tags', [
  'siteMethods' => [
    'getAllTags' => function () {
      // return [];
        $acc = [];

        foreach (site()->index() as $page) {
        
          $tagsList = $page->tags()->toObject()->other()->value();
          if (is_null($tagsList)) {
            continue;
          }
          $tagsArray = explode(',', $tagsList);
   
          foreach ($tagsArray as $tag) {
            if ($tag !== '') {
              $acc[] = trim($tag);
            }
          }
        }

        $acc = array_unique($acc, SORT_STRING);
        return $acc;

    }
  ]
]);
