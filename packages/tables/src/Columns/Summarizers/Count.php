<?php

namespace Filament\Tables\Columns\Summarizers;

use Exception;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;

use function Filament\Support\generate_icon_html;
use function Filament\Support\get_color_css_variables;

class Count extends Summarizer
{
    protected bool $hasIcons = false;

    protected ?string $selectAlias = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->numeric();
    }

    /**
     * @return int | float | array<string, array<string, int>> | null
     */
    public function summarize(Builder $query, string $attribute): int | float | array | null
    {
        if (! $this->hasIcons) {
            return $query->count();
        }

        $column = $this->getColumn();

        if (! ($column instanceof IconColumn)) {
            throw new Exception("The [{$column->getName()}] column must be an IconColumn to show an icon count summary.");
        }

        $state = [];

        foreach ($query->clone()->distinct()->pluck($attribute) as $value) {
            $column->record($this->getQuery()->getModel()->setAttribute($attribute, $value));
            $columnState = $column->getState();
            $color = json_encode($column->getColor($columnState));
            $icon = $column->getIcon($columnState);

            $state[$color] ??= [];
            $state[$color][$icon] ??= 0;

            $state[$color][$icon] += $query->clone()->where($attribute, $value)->count();
        }

        return $state;
    }

    /**
     * @return array<string, string>
     */
    public function getSelectStatements(string $column): array
    {
        if ($this->hasIcons) {
            return [];
        }

        return [
            $this->getSelectAlias() => "count({$column})",
        ];
    }

    public function getSelectedState(): int | float | null
    {
        if (! array_key_exists($this->selectAlias, $this->selectedState)) {
            return null;
        }

        return $this->selectedState[$this->getSelectAlias()];
    }

    public function selectAlias(?string $alias): static
    {
        $this->selectAlias = $alias;

        return $this;
    }

    public function getSelectAlias(): string
    {
        return $this->selectAlias ??= Str::random();
    }

    public function icons(bool $condition = true): static
    {
        $this->hasIcons = $condition;

        return $this;
    }

    public function getDefaultLabel(): ?string
    {
        return $this->hasIcons ? null : __('filament-tables::table.summary.summarizers.count.label');
    }

    public function hasIcons(): bool
    {
        return $this->hasIcons;
    }

    public function toEmbeddedHtml(): string
    {
        if ($this->hasIcons()) {
            $attributes = $this->getExtraAttributeBag()
                ->class(['fi-ta-icon-count-summary']);

            ob_start(); ?>

            <div <?= $attributes->toHtml() ?>>
                <?php if (filled($label = $this->getLabel())) { ?>
                    <span class="fi-ta-icon-count-summary-label">
                        <?= $label ?>
                    </span>
                <?php } ?>

                <?php if ($state = $this->getState()) { ?>
                    <ul>
                        <?php foreach ($state as $color => $icons) { ?>
                            <?php $color = json_decode($color); ?>

                            <?php foreach ($icons as $icon => $count) { ?>
                                <li>
                                    <span>
                                        <?= $count ?>
                                    </span>

                                    <?= generate_icon_html(
                                        $icon,
                                        attributes: (new ComponentAttributeBag)
                                            ->class([
                                                match ($color) {
                                                    null, 'gray' => null,
                                                    default => 'fi-color-custom',
                                                },
                                                is_string($color) ? "fi-color-{$color}" : null,
                                            ])
                                            ->style([
                                                get_color_css_variables(
                                                    $color,
                                                    shades: [400, 500],
                                                    alias: 'tables::columns.summaries.icon-count.icon',
                                                ) => $color !== 'gray',
                    ])
                                    )->toHtml() ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>

            <?php return ob_get_clean();
        }

        return parent::toEmbeddedHtml();
    }
}
