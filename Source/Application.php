<?php

namespace Liloi\Umklaidet;

use Rune\Application as RuneApplication;

/**
 * @inheritDoc
 */
class Application extends RuneApplication
{
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
        $this->setLayout(__DIR__ . '/Templates/Layout.tpl');

        return $this->render($this->getLayout(), [
        ]);
    }
}