<?php

namespace Rowboat\Editor\Models\Component\Moloquent;

use Rowboat\Core\Models\Component\Moloquent\MoloquentComponentContent;

abstract class MoloquentComponentEditorContent extends MoloquentComponentContent {

    public function addNewVersion($content, $container) {
        $myContent = new $this;
        $myContent->content = $content;
        $myContent->save();
        $container->contents()->save($myContent);
    }

}
