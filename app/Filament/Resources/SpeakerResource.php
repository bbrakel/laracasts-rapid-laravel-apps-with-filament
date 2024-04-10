<?php

namespace App\Filament\Resources;

use App\Enums\TalkStatus;
use App\Filament\Resources\SpeakerResource\Pages;
use App\Filament\Resources\SpeakerResource\RelationManagers\TalksRelationManager;
use App\Models\Speaker;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SpeakerResource extends Resource
{
    protected static ?string $model = Speaker::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Speaker::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('twitter_handle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): InfoList
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->columns(3)
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('avatar')
                            ->label('')
                            ->collection('avatars')
                            ->circular()
                            ->defaultImageUrl(function (Speaker $speaker) {
                                return "https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=$speaker->name";
                            }),
                        Group::make()
                            ->columnSpan(2)
                            ->columns(2)
                            ->schema([
                                TextEntry::make('name'),
                                TextEntry::make('email'),
                                TextEntry::make('twitter_handle')
                                    ->getStateUsing(function (Speaker $speaker) {
                                        return '@' . $speaker->twitter_handle;
                                    })
                                    ->label('Twitter')
                                    ->url(function (Speaker $speaker) {
                                        return "https://twitter.com/$speaker->twitter_handle";
                                    }),
                                TextEntry::make('has_spoken')
                                    ->getStateUsing(function (Speaker $speaker) {
                                        return $speaker->talks()->where('status', TalkStatus::APPROVED)->count() > 0 ? 'Previous Speaker' : 'Has Not Spoken';
                                    })
                                    ->color(function ($state) {
                                        return $state === 'Previous Speaker'
                                            ? 'success'
                                            : 'primary';
                                    })
                                    ->badge()
                            ])

                    ]),
                Section::make('About')
                    ->schema([
                        TextEntry::make('bio')
                            ->extraAttributes(['class' => 'prose dark:prose-invert'])
                            ->html(),
                        TextEntry::make('qualifications')
                            ->listWithLineBreaks()
                            ->bulleted()
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TalksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpeakers::route('/'),
            'create' => Pages\CreateSpeaker::route('/create'),
            'view' => Pages\ViewSpeaker::route('/{record}')
        ];
    }
}
