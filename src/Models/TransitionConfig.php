<?php

namespace HighLiuk\XState\Models;

readonly class TransitionConfig
{
    public function __construct(public string $target)
    {
    }
}
