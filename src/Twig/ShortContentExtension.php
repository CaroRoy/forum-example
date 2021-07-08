<?php 

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ShortContentExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('truncate', [
                $this, 'truncate'
            ]) 
        ];
    }

    public function truncate($value)
    {
        $finalValue = substr($value,0,100);

        return $finalValue . ' ...';
    }
}