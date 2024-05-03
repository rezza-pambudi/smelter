<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\ManageUser;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ManageUserResource\Pages;
use App\Filament\Resources\ManageUserResource\RelationManagers;

class ManageUserResource extends Resource
{
    protected static ?string $model = ManageUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Operation Management';

    protected static ?string $navigationLabel = 'Data Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('id')->unique(ignorable: fn ($record) => $record)->hidden()->afterStateUpdated(function (?string $state, ?string $old) {
                            $state()->update();
                        }),
                        TextInput::make('nama')->required(),
                        TextInput::make('email')->required(),
                        Select::make('team')->options([
                            'Sales' => 'Sales',
                            'MS' => 'MS',
                            'Ads Ops' => 'Ads Ops',
                            'Produk' => 'Produk',
                            'Brandcomm' => 'Brandcomm',
                            'Content' => 'Content',
                            'IT' => 'IT',
                            'Other' => 'Other'
                        ])
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('team')->sortable()->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListManageUsers::route('/'),
            'create' => Pages\CreateManageUser::route('/create'),
            'edit' => Pages\EditManageUser::route('/{record}/edit'),
        ];
    }
}
