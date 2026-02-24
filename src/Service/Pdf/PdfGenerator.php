<?php

namespace App\Service\Pdf;

use Sensiolabs\GotenbergBundle\GotenbergPdfInterface;
use Symfony\Component\HttpFoundation\Response;

class PdfGenerator
{
    public function __construct(
        private GotenbergPdfInterface $gotenberg
    ) {}
    /**
     * @param array<string, mixed> $data
     */
    public function generate(
        string $template,
        array $data,
    ): Response {

        return $this->gotenberg
            ->html()
            ->content($template, $data)
            ->generate()
            ->stream();
    }
}
