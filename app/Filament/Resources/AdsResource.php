<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsResource\Pages;
use App\Filament\Resources\AdsResource\RelationManagers;
use App\Models\Ads;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsResource extends Resource
{

    protected static ?string $model = Ads::class;

    protected static ?string $navigationLabel= 'Regular Ads';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $activeNavigationIcon = 'heroicon-o-chevron-double-right';

    protected static ?string $navigationGroup = 'Advertisements';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description(__('Availability'))
                    ->schema([
                        Forms\Components\Toggle::make('is_negotiable')
                            ->required(),
                        Forms\Components\Toggle::make('status')
                            ->required(),
                        Forms\Components\Toggle::make('is_featured')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                        Forms\Components\Toggle::make('is_premium_extra')
                            ->required(),
                        Forms\Components\Toggle::make('is_approved')
                            ->required(),
                        Section::make()
                            ->description(__('Sorting & Views'))
                            ->schema([
                                Forms\Components\TextInput::make('sort_order')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('views')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(2),
                    ])
                ->columns(3),

                Section::make()
                    ->description(__('Ad Description'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'title' . '->' . config('dealz.app_locale'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('label'),
                        Forms\Components\Textarea::make('description')
                            ->autosize()
                            ->columnSpanFull(),

                        Section::make()
                        ->description('Attribute list')
                        ->schema([
                            Forms\Components\KeyValue::make('attributes')
                                ->required()
                                ->editableKeys(false)
                                ->columnSpanFull(),
                        ]),
                    ])
                    ->columns(3),

                Section::make()
                    ->description(__('Contacts'))
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required(),
                        Forms\Components\TextInput::make('whatsapp')
                            ->tel(),
                        Forms\Components\TextInput::make('latitude')
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric(),
                    ])
                    ->columns(4),

                Section::make()
                    ->description(__('Finance'))
                    ->schema([
                        Forms\Components\Select::make('client_id')
                            ->relationship('client', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('package_id')
                            ->searchable()
                            ->preload()
                            ->relationship('package', 'title' . '->' . config('dealz.app_locale')),
                        Forms\Components\TextInput::make('subscriptions_id')
                            ->disabled()
                            ->numeric(),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->suffix('KWD'),
                        Forms\Components\DatePicker::make('start_date')
                            ->native(false)
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->native(false),
                    ])
                    ->columns(3),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory(date('Ymd'))
                    ->openable()
                    ->multiple()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label(__('Approved'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_premium_extra')
                    ->label(__('Premium'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('Featured'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAds::route('/'),
            'create' => Pages\CreateAds::route('/create'),
            'view' => Pages\ViewAds::route('/{record}'),
            'edit' => Pages\EditAds::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
