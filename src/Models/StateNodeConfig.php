<?php

namespace HighLiuk\XState\Models;

use HighLiuk\XState\StateNode;

readonly class StateNodeConfig
{
    /**
     * @param (TransitionConfig|string)[] $on
     * @param self[] $states
     */
    public function __construct(
        public ?string $id = null,
        public ?string $initial = null,
        public ?array $on = null,
        public ?StateNode $parent = null,
        public ?array $states = null,
        public ?string $target = null
    ) {
    }
}
