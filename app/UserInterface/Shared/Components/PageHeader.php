<?php

declare(strict_types=1);

namespace Interface\Shared\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PageHeader extends Component
{
    public function render(): View
    {
        return view('shared::layouts.page-header');
    }
}
