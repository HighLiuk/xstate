<?php

namespace HighLiuk\XState\Models;

use HighLiuk\XState\StateMachine;
use HighLiuk\XState\StateNode;

readonly class StateNodeOptions
{
    public function __construct(
        public string $key,
        public StateMachine $machine,
        public ?StateNode $parent = null
    ) {
    }
}
