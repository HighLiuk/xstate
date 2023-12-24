<?php

namespace HighLiuk\XState;

use HighLiuk\XState\Models\StateNodeConfig;
use HighLiuk\XState\Models\StateNodeOptions;
use HighLiuk\XState\Models\TransitionConfig;

class StateNode
{
    readonly protected string $key;
    readonly protected StateMachine $machine;
    readonly protected ?self $parent;
    /** @var list<string> */
    readonly protected array $path;
    readonly protected string $id;
    /** @var self[] */
    protected array $states;
    /** @var TransitionConfig[] */
    protected array $transitions;

    public function __construct(
        protected StateNodeConfig $config,
        protected StateNodeOptions $options
    ) {
        $this->key = $this->options->key;
        $this->machine = $this->options->machine;
        $this->parent = $this->options->parent;
        $this->path = $this->parent ? [...$this->parent->path, $this->key] : [];
        $this->id = $this->config->id ?: implode('.', [$this->machine->id, ...$this->path]);

        $this->states = [];
        foreach ($this->config->states ?? [] as $key => $state_config) {
            $state_options = new StateNodeOptions(
                key: $key,
                machine: $this->machine,
                parent: $this
            );
            $this->states[$key] = new self($state_config, $state_options);
        }
    }

    public function initialize(): void
    {
        $this->transitions = $this->formatTransitions();

        foreach ($this->states as $state) {
            $state->initialize();
        }
    }

    /**
     * @return TransitionConfig[]
     */
    protected function formatTransitions(): array
    {
        return array_map(
            fn (TransitionConfig|string $transition_config) => is_string($transition_config)
                ? new TransitionConfig(
                    target: $transition_config,
                )
                : $transition_config,
            $this->config->on ?? []
        );
    }
}
