<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReferralCard extends Component
{
    public $direct;

    /**
     * Create a new component instance.
     */
    public function __construct($direct)
    {
        $this->direct = $direct;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.referral-card');
    }
}
