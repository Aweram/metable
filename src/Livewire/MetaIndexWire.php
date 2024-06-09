<?php

namespace Aweram\Metable\Livewire;

use Livewire\Component;

class MetaIndexWire extends Component
{
    public bool $displayData = false;
    public int|null $metaId = null;

    public string $name = "";
    public string $content = "";
    public string $property = "";

    public function render()
    {
        return view('ma::livewire.admin.metas');
    }

    public function showCreate(): void
    {
        $this->resetFields();
        // TODO: check auth

        $this->displayData = true;
    }

    private function resetFields(): void
    {
        $this->reset(["name", "content", "property", "metaId"]);
    }
}
