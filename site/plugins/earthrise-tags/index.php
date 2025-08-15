<?php
// TODO: rewrite this plugin, currently written with AI as proof of concept
Kirby::plugin('earthrise/tags', [
  'siteMethods' => [
    'getAllTags' => function () {
      try {
        $acc = [];

        foreach (site()->index() as $page) {
          // skip page if it doesn't have the 'tags' field
          if (! $page->content()->has('tags')) {
            continue;
          }
          // skip page if the 'tags' field is empty
          $tagsField = $page->tags();
          if (! $tagsField || $tagsField->isEmpty()) {
            continue;
          }
          // create an object from the tags field
          $structure = $tagsField->toStructure();
          foreach ($structure as $row) {
            // guard if the subfield doesn't exist on this row
            if (! $row->has('other')) {
              continue;
            }

            $raw = (string) $row->other()->value();

            if ($raw === '') {
              continue;
            }

            // split comma-separated values (typical tags storage)
            foreach (array_map('trim', explode(',', $raw)) as $part) {
              if ($part !== '') {
                $acc[] = $part;
              }
            }
          }
        }

        // dedupe, sort, reindex and return plain array
        $acc = array_unique($acc, SORT_STRING);
        natcasesort($acc);
        return array_values($acc);

      } catch (Throwable $e) {
        // log and return empty array (do not crash the Panel)
        kirby()->log('tag-options:getAllTags error: ' . $e->getMessage());
        return [];
      }
    }
  ]
]);
