<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsCategoryResource\Pages;
use App\Filament\Resources\AdsCategoryResource\RelationManagers;
use App\Models\AdsCategory;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsCategoryResource extends Resource
{
    use Translatable;
    protected static ?string $model = AdsCategory::class;

    protected static ?string $label = 'Categories';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $activeNavigationIcon = 'heroicon-o-chevron-double-right';
    protected static ?string $navigationGroup = 'Advertisements';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric(),
                        Forms\Components\Toggle::make('is_featured')
                            ->required(),
                        Forms\Components\Toggle::make('status')
                            ->required(),
                    ])
                    ->columns(3),

                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\TextInput::make('label')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ])
                ->columns(2),

                Section::make()
                    ->schema([
                        Forms\Components\Select::make('parent_id')
                            ->searchable()
                            ->preload()
                            ->relationship('parent', 'title' . '->' . config('dealz.app_locale')),
                        Forms\Components\FileUpload::make('icon')
                            ->image()
                            ->disk('public')
                            ->directory(date('Ymd'))
                            ->openable(),
                    ])
                    ->columns(2),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory(date('Ymd'))
                    ->openable()
                    ->columnSpanFull()
                    ->multiple(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
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
            'index' => Pages\ListAdsCategories::route('/'),
            'create' => Pages\CreateAdsCategory::route('/create'),
            'view' => Pages\ViewAdsCategory::route('/{record}'),
            'edit' => Pages\EditAdsCategory::route('/{record}/edit'),
        ];
    }
}
