<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsCommentResource\Pages;
use App\Filament\Resources\AdsCommentResource\RelationManagers;
use App\Models\AdsComment;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsCommentResource extends Resource
{
    protected static ?string $model = AdsComment::class;
    protected static ?string $label = 'Comments';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left';
    protected static ?string $activeNavigationIcon = 'heroicon-o-chevron-double-right';
    protected static ?string $navigationGroup = 'Clients';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Forms\Components\Toggle::make('is_approved')
                        ->required(),
                ]),
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('client_id')
                            ->searchable()
                            ->preload()
                            ->relationship('client', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('comment')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ad_type')
                    ->label(__('Ad Section'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListAdsComments::route('/'),
            'create' => Pages\CreateAdsComment::route('/create'),
            'view' => Pages\ViewAdsComment::route('/{record}'),
            'edit' => Pages\EditAdsComment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
