<?php

namespace Liloi\Umklaidet;

use Rune\Application as RuneApplication;

use Liloi\Elscript\Elscript;

/**
 * @inheritDoc
 */
class Application extends RuneApplication
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
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
        $this->setLayout(__DIR__ . '/Templates/Layout.tpl');

        $layout = file_get_contents($this->config['layout']);
        $parser = new Elscript();

        return $this->render($this->getLayout(), [
            'title' => $this->config['title'],
            'layout' => $parser->parse($layout)->getOutput(),
            'background' => $this->config['background'],
        ]);
    }
}