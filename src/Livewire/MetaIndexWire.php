<?php

namespace Aweram\Metable\Livewire;

use Aweram\Metable\Interfaces\MetaModelInterface;
use Aweram\Metable\Interfaces\ShouldMetaInterface;
use Aweram\Metable\Models\Meta;
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

    public bool $displayDelete = false;

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
        $metaClass = config("metable.customMetaModel") ?? Meta::class;
        $metas = $metaClass::query()
            ->select("id", "name", "content", "property", "separated")
            ->orderBy("name")
            ->get();
        return view('ma::livewire.admin.metas', compact("metas"));
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

    public function showEdit(int $metaId): void
    {
        $this->resetFields();
        $this->metaId = $metaId;
        // Найти тег
        $meta = $this->findMeta();
        if (! $meta) return;

        $this->name = $meta->name;
        $this->content = $meta->content;
        $this->property = $meta->property;
        $this->separated = $meta->separated ? true : false;

        $this->displayData = true;
    }

    public function update(): void
    {
        // Найти тег
        $meta = $this->findMeta();
        if (! $meta) return;
        // Валидация
        $this->validate();
        $meta->update([
            "name" => $this->name,
            "content" => $this->content,
            "property" => $this->property,
            "separated" => $this->separated ? now() : null,
        ]);
        $this->closeData();
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showDelete(int $metaId): void
    {
        $this->resetFields();
        $this->metaId = $metaId;
        // Найти тег
        $meta = $this->findMeta();
        if (! $meta) return;

        $this->displayDelete = true;
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    public function confirmDelete(): void
    {
        // Найти тег
        $meta = $this->findMeta();
        if (! $meta) return;

        $meta->delete();
        session()->flash("success", __("Meta tag successfully deleted"));

        $this->closeDelete();
    }

    private function resetFields(): void
    {
        $this->reset(["name", "content", "property", "metaId"]);
    }

    private function findMeta(): ?MetaModelInterface
    {
        $metaClass = config("metable.customMetaModel") ?? Meta::class;
        $meta = $metaClass::find($this->metaId);
        if (! $meta) {
            session()->flash("error", __("Meta tag not found"));
            $this->closeData();
            return null;
        }
        return $meta;
    }
}
