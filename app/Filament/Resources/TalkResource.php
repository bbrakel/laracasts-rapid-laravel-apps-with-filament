<?php

namespace App\Filament\Resources;

use App\Enums\TalkLength;
use App\Enums\TalkStatus;
use App\Filament\Resources\TalkResource\Pages;
use App\Models\Talk;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TalkResource extends Resource
{
    protected static ?string $model = Talk::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Second Group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Talk::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->description(function (Talk $talk) {
                        return Str::of($talk->abstract)->limit(40);
                    }),
                SpatieMediaLibraryImageColumn::make('speaker.avatar')
                    ->collection('avatars')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(function ($record) {
                        return 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . urlencode($record->speaker->name);
                    }),
                Tables\Columns\TextColumn::make('speaker.name')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                // ToggleColumn::make('new_talk'),
                IconColumn::make('new_talk')
                    ->label('New')
                    ->boolean(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
                IconColumn::make('length')
                    ->icon(function ($state) {
                        return match ($state) {
                            TalkLength::NORMAL => 'heroicon-o-megaphone',
                            TalkLength::LIGHTNING => 'heroicon-o-bolt',
                            TalkLength::KEYNOTE => 'heroicon-o-key',
                        };
                    }),
            ])
            ->filters([
                SelectFilter::make('speaker')
                    ->relationship('speaker', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),
                Filter::make('new_talk')
                    ->label('Only New Talks')
                    ->toggle()
                    ->query(function ($query) {
                        return $query->where('new_talk', true);
                    }),
                Filter::make('has_avatar')
                    ->label('Only with Avatar')
                    ->toggle()
                    ->query(function ($query) {
                        return $query->whereHas('speaker', function (Builder $query) {
                            $query->whereHas('media');
                        });
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideover(),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('approve')
                        ->disabled(function (Talk $talk) {
                            return $talk->status !== TalkStatus::SUBMITTED;
                        })
                        ->tooltip('already accepted')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Talk $talk) {
                            $talk->approve();
                        })
                        ->after(function () {
                            Notification::make()
                                ->success()
                                ->duration(5000)
                                ->title('This talk was approved')
                                ->body('The speaker has been notified and the talk has been added to the conference schedule.')
                                ->send();
                        }),
                    Tables\Actions\Action::make('reject')
                        ->disabled(function (Talk $talk) {
                            return $talk->status !== TalkStatus::SUBMITTED;
                        })
                        ->requiresConfirmation()
                        ->icon('heroicon-o-no-symbol')
                        ->color('danger')
                        ->action(function (Talk $talk) {
                            $talk->reject();
                        })
                        ->after(function () {
                            Notification::make()
                                ->success()
                                ->duration(5000)
                                ->title('This talk was approved')
                                ->body('The speaker has been notified and the talk has been added to the conference schedule.')
                                ->send();
                        })
                ])
                    ->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('approve')
                        ->action(function (Collection $talks) {
                            $talks->each->approve();
                        })
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->tooltip('This will display all the filtered rows in an array on a new model.')
                    ->action(function ($livewire) {
                        dd($livewire->getFilteredTableQuery()->get()->toArray());
                    })
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTalks::route('/'),
            'create' => Pages\CreateTalk::route('/create'),
            // 'edit' => Pages\EditTalk::route('/{record}/edit'),
        ];
    }
}
