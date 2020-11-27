<?php

namespace Liloi\Umklaidet;

use Rune\Application as RuneApplication;

use Liloi\Elscript\Elscript;

/**
 * @inheritDoc
 */
class Application extends RuneApplication
{
    private $storyFileName;

    public function __construct(string $storyFileName)
    {
        $this->storyFileName = $storyFileName;
    }

    protected function render(string $template, array $data = []): string
    {
        extract($data);

        ob_start();
        include($template);
        $output = ob_get_clean();

        return $output;
    }

    /**
     * Compiles page.
     *
     * @return string Full output page.
     */
    public function compile(): string
    {
        $story = new Story($this->storyFileName);

        return $story->compile();
    }
}