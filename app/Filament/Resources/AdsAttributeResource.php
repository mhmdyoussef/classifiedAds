<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsAttributeResource\Pages;
use App\Filament\Resources\AdsAttributeResource\RelationManagers;
use App\Models\AdsAttribute;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsAttributeResource extends Resource
{
    use Translatable;
    protected static ?string $model = AdsAttribute::class;

    protected static ?string $navigationLabel = 'Attributes';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $activeNavigationIcon = 'heroicon-o-chevron-double-right';
    protected static ?string $navigationGroup = 'Advertisements';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('attribute_name')
                            ->required(),

                        Forms\Components\Select::make('attribute_type')
                            ->searchable()
                            ->preload()
                            ->options([
                                'input' => 'Regular Field',
                                'checkbox' => 'Checkbox',
                                'radio' => 'Radio',
                                'select' => 'Options',
                            ])
                            ->required(),

                        Forms\Components\Select::make('category_id')
                            ->label(__('Attribute required in:'))
                            ->relationship('category', 'title' . '->' . config('dealz.app_locale'))
                            ->required(),
                    ])
                    ->columns(3),

                Section::make()
                    ->schema([
                        Forms\Components\KeyValue::make('attribute_value')
                            ->label(__('Attribute Options'))
                            ->keyLabel(__('Attribute Name'))
                            ->valueLabel(__('Attribute Value (By Client)'))
                            ->reorderable()
                            ->editableValues(false)
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(),

                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attribute_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attribute_type')
                    ->searchable(),
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
            'index' => Pages\ListAdsAttributes::route('/'),
            'create' => Pages\CreateAdsAttribute::route('/create'),
            'view' => Pages\ViewAdsAttribute::route('/{record}'),
            'edit' => Pages\EditAdsAttribute::route('/{record}/edit'),
        ];
    }
}
