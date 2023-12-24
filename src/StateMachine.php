<?php

namespace HighLiuk\XState;

use HighLiuk\XState\Models\StateNodeConfig;
use HighLiuk\XState\Models\StateNodeOptions;

readonly class StateMachine
{
    public string $id;
    protected StateNode $root;

    public function __construct(protected StateNodeConfig $config)
    {
        $this->id = $config->id ?: '(machine)';
        $this->root = new StateNode(
            $config,
            new StateNodeOptions(
                key: $this->id,
                machine: $this
            )
        );
        $this->root->initialize();
    }
}
