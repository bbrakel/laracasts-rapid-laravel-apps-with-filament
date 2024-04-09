<?php

namespace App\Models;

use App\Enums\Region;
use App\Enums\Status;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Conference extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'venue_id' => 'integer',
        'status' => Status::class,
        'region' => Region::class,
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function talks(): BelongsToMany
    {
        return $this->belongsToMany(Talk::class);
    }

    public static function getForm(): array
    {
        return [
            Tabs::make()
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Conference Details')
                        ->schema([
                            TextInput::make('name')
                                ->columnSpanFull()
                                ->label('Conference Name')
                                ->default('My Conference')
                                ->required()
                                ->maxLength(60),
                            MarkdownEditor::make('description')
                                ->columnSpanFull()
                                ->required()
                                ->maxLength(255),
                            DateTimePicker::make('start_date')
                                ->native(false)
                                ->required(),
                            DateTimePicker::make('end_date')
                                ->native(false)
                                ->required(),

                        ]),
                    Tabs\Tab::make('Location')
                        ->schema([
                            Select::make('region')
                                ->live()
                                ->enum(Region::class)
                                ->options(Region::class),
                            Select::make('venue_id')
                                ->searchable()
                                ->preload()
                                ->editOptionForm(Venue::getForm())
                                ->createOptionForm(Venue::getForm())
                                ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                                    return $query->where('region', $get('region'));
                                }),
                            Fieldset::make('Status')
                                ->columns(1)
                                ->schema([
                                    Select::make('status')
                                        ->options(Status::class)
                                        ->required(),
                                    Toggle::make('is_published'),
                                ]),
                        ]),
                    Tabs\Tab::make('Speakers')
                        ->schema([
                            CheckboxList::make('speakers')
                                ->columnSpanFull()
                                ->relationship('speakers', 'name')
                                ->options(Speaker::all()->pluck('name', 'id'))
                                ->required()
                                ->columns(3),
                        ])
                ]),
            Actions::make([
                Action::make('star')
                    ->label('Fill with Factory Data')
                    ->icon('heroicon-m-star')
                    ->visible(function (string $operation) {
                        if ($operation !== 'create') {
                            return false;
                        }
                        if (! app()->environment('local')) {
                            return false;
                        }

                        return true;
                    })
                    ->action(function ($livewire) {
                        $data = Conference::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    })
            ]),
        ];
    }
}
