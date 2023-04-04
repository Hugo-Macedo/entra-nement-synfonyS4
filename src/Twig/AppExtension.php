<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('stars', [$this, 'stars'], ['is_safe' => ['html']]),
            new TwigFilter('dateFr', [$this, 'date']),
            new TwigFilter('formatPhone', [$this, 'formatPhone']),
        ];
    }

    public function stars($note)
    {
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<i class="fas fa-star"></i>'; //sous réserve que fontawesome soit chargé
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '<i class="far fa-star"></i>'; //sous réserve que fontawesome soit chargé
        }

        return $html;
    }

    public function date(): string
    {
        return date('d/m/Y');
    }

    public function formatPhone($num)
    {
        if (str_contains($num, '+')) {
            $num2 = substr($num, 1);
            echo '+';
            return wordwrap($num2, 2, ' ', true);
        } else {
            return wordwrap($num, 2, ' ', true);
        }
    }
}