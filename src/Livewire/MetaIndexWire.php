<?php

namespace Aweram\Metable\Livewire;

use Aweram\Metable\Interfaces\ShouldMetaInterface;
use Livewire\Component;

class MetaIndexWire extends Component
{
    public ShouldMetaInterface $model;

    public bool $displayData = false;
    public int|null $metaId = null;

    public string $name = "";
    public string $content = "";
    public string|null $property = null;
    public bool $separated = false;

    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:50"],
            "content" => ["required", "string"],
            "property" => ["nullable", "string", "max:50"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "name" => "Name",
            "content" => "Content",
            "property" => "Property"
        ];
    }

    public function render()
    {
        return view('ma::livewire.admin.metas');
    }

    public function showCreate(): void
    {
        $this->resetFields();
        $this->displayData = true;
    }

    public function store(): void
    {
        // Валидация
        $this->validate();
        $this->model->metas()->create([
            "name" => $this->name,
            "content" => $this->content,
            "property" => $this->property,
            "separated" => $this->separated ? now() : null,
        ]);

        session()->flash("success", __("Meta tag successfully added"));
        $this->closeData();
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    private function resetFields(): void
    {
        $this->reset(["name", "content", "property", "metaId"]);
    }
}
