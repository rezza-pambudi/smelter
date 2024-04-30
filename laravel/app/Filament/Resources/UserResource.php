<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
// use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Livewire\Livewire;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
 
    protected static ?string $navigationLabel = 'Data Login';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Form Tambah User')
                ->description('Case Sensitif, Silakan isi dengan cermat')
                ->schema([
                    TextInput::make(name: 'id')->required()->unique(ignorable: fn ($record) => $record)->live(onBlur: true)->hidden(),
                    TextInput::make(name: 'name')->required(),
                    TextInput::make(name: 'email')->required()->email()->rule(
                        fn ($record) => 'unique:users,email,'
                            . ($record ? $record->id : 'NULL')
                            . ',id'
                    ),
                    TextInput::make(name: 'password')
                    ->password()
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->dehydrated(fn(?string $state): bool => filled($state)),
                    // ->require(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
                    // Select::make('roles')->searchable()->options([
                    //     'Super-admin' => 'super-admin',
                    //     'Admin' => 'admin',
                    //     'Member' => 'member',
                    // ])
                    Select::make('roles')->multiple()->relationship('roles','name')
                ])->columns(columns: 2)

        ])->columns(columns: 2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('roles.name')->sortable()->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
