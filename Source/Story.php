<?php

namespace Liloi\Umklaidet;

use Liloi\Elscript\Elscript;

class Story
{
    private $storyFileName;

    private $xml;

    private $root;

    public function __construct(string $storyFileName)
    {
        $this->storyFileName = $storyFileName;
        $this->xml = simplexml_load_file($storyFileName);
        $this->root = dirname($storyFileName);
    }

    protected function render(string $template, array $data = []): string
    {
        extract($data);

        ob_start();
        include($template);
        $output = ob_get_clean();

        return $output;
    }

    public function compile(): string
    {
//        die(var_dump(__LINE__, $this->xml));
        return $this->render(__DIR__ . '/Templates/Layout.tpl', [
            'title' => $this->xml['title'],
            'content' => $this->getContent($this->getStartupId())
        ]);
    }

    /* ---------------------------------------------------------------- */

    public function getStartupId(): string
    {
        return $this->xml['start'];
    }

    public function getContent(string $id)
    {
        $tiles = null;
        foreach($this->xml->children() as $child)
        {
            if($child->getName() == 'tiles') {
                $tiles = $child;
                break;
            }
        }

        $tile = null;

        foreach ($tiles->children() as $child)
        {
            if($child['id'] != $id) {
                continue;
            }

            $tile = $child;
        }

        return $this->getContentHtml($tile);
    }

    private function getContentHtml($tile): string
    {
        return $this->render(__DIR__ . '/Templates/Html.tpl', [
            'content' => $tile->asXML()
        ]);
    }
}