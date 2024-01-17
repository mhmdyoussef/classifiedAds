<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsPackageResource\Pages;
use App\Filament\Resources\AdsPackageResource\RelationManagers;
use App\Models\AdsPackage;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsPackageResource extends Resource
{
    use Translatable;
    protected static ?string $model = AdsPackage::class;

    protected static ?string $navigationLabel = 'Packages';
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $activeNavigationIcon = 'heroicon-o-chevron-double-right';
    protected static ?string $navigationGroup = 'Advertisements';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description(__('Availability'))
                    ->schema([
                        Forms\Components\Toggle::make('is_featured'),
                        Forms\Components\Toggle::make('is_premium_package'),
                        Forms\Components\Toggle::make('status')
                            ->required(),
                    ])
                    ->columns(3),

                Section::make()
                    ->description(__('Ad Description'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->columns()
                            ->required(),
                        Forms\Components\TextInput::make('label'),
                        Forms\Components\Textarea::make('description')
                            ->autosize()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Package details')
                    ->schema([
                        Forms\Components\TextInput::make('duration')
                            ->prefix('day')
                            ->numeric(),
                        Forms\Components\TextInput::make('price')
                            ->prefix('KWD')
                            ->numeric(),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric(),
                    ])
                    ->columns(3),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('KWD')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_premium_package')
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
            'index' => Pages\ListAdsPackages::route('/'),
            'create' => Pages\CreateAdsPackage::route('/create'),
            'view' => Pages\ViewAdsPackage::route('/{record}'),
            'edit' => Pages\EditAdsPackage::route('/{record}/edit'),
        ];
    }

}
