<?php

namespace Naif\Paypal;

use Laravel\Nova\Card;

class Paypal extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/2';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'paypal';
    }

    public function days($days = 5)
    {
        $this->withMeta([
            'days' => $days
        ]);
        return $this;
    }

    public function count($count = 10)
    {
        $this->withMeta([
            'count' => $count
        ]);
        return $this;
    }

    public function hideLogo($hide = false)
    {
        $this->withMeta([
            'hide_logo' => $hide
        ]);
        return $this;
    }
}
