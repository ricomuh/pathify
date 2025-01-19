<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    // ->avatar()
                    ->label('Thumbnail')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required(),
                Forms\Components\Textarea::make('body')
                    ->label('Description')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->label('End Date')
                    ->required(),
                Forms\Components\Checkbox::make('is_online')
                    ->label('Is Online')
                    ->live(),

                Forms\Components\Group::make([
                    Forms\Components\Select::make('platform')
                        // ->when(
                        //     fn($record) => $record->is_online,
                        //     fn($component) => $component->required()
                        // )
                        ->options([
                            'zoom' => 'Zoom',
                            'google_meet' => 'Google Meet',
                            'microsoft_teams' => 'Microsoft Teams',
                            'webex' => 'Webex',
                            'gotomeeting' => 'GoToMeeting',
                            'jitsi_meet' => 'Jitsi Meet',
                            'whereby' => 'Whereby',
                            'skype' => 'Skype',
                            'discord' => 'Discord',
                            'slack' => 'Slack',
                            'microsoft_skype_for_business' => 'Microsoft Skype for Business',
                            'cisco_webex' => 'Cisco Webex',
                            'bluejeans' => 'BlueJeans',
                            'lifesize' => 'Lifesize',
                            'starleaf' => 'StarLeaf',
                        ])
                        ->label('Platform')
                        ->required(),
                    Forms\Components\TextInput::make('link')
                        ->label('Link')
                        ->url()
                        ->required(),
                ])->hidden(fn(Get $get): bool => !$get('is_online')),

                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('location_name')
                        ->label('Location Name')
                        ->required(),
                    Forms\Components\TextInput::make('location_address')
                        ->label('Location Address')
                        ->required(),
                ])->hidden(fn(Get $get): bool => $get('is_online')),

                // Forms\Components\TextInput::make('location_name')
                //     ->label('Location Name')
                //     ->required(),
                // Forms\Components\TextInput::make('location_address')
                //     ->label('Location Address')
                //     ->required(),
                Forms\Components\DateTimePicker::make('registration_start_date')
                    ->label('Registration Start Date')
                    ->required(),
                Forms\Components\DateTimePicker::make('registration_end_date')
                    ->label('Registration End Date')
                    ->required(),
                Forms\Components\TextInput::make('quota')
                    ->numeric()
                    ->label('Quota')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->required(),
                // Forms\Components\Textarea::make('rundown')
                //     ->label('Rundown')
                //     ->required(),
                // Forms\Components\Textarea::make('faqs')
                //     ->label('FAQs')
                //     ->required(),
                Forms\Components\Repeater::make('rundown')
                    ->label('Rundown')
                    ->schema([
                        Forms\Components\TimePicker::make('time')
                            ->label('Time')
                            ->required(),
                        Forms\Components\TimePicker::make('end')
                            ->label('End')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->required(),
                    ]),
                Forms\Components\Repeater::make('faqs')
                    ->label('FAQs')
                    ->schema([
                        Forms\Components\TextInput::make('question')
                            ->label('Question')
                            ->required(),
                        Forms\Components\Textarea::make('answer')
                            ->label('Answer')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    // ->thumbnail()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    // ->primary()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('users_count')->counts('users')
                    ->label('Joined Users')
                    ->sortable(),
                Tables\Columns\TextColumn::make('quota')
                    ->label('Quota')
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
