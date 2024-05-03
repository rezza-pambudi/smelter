<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Brand;
use App\Models\Result;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RequestDesign;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Card;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Actions\ForceDeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ResultResource\Pages;
use Filament\Infolists\Components\Actions\Action;
use AnourValar\EloquentSerialize\Tests\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ResultResource\RelationManagers;
use App\Filament\Resources\ResultResource\RelationManagers\RequestDesignRelationManager;

class ResultResource extends Resource
{

    protected static ?string $model = Result::class;

    protected static ?string $modelLabel = 'Kelola Desain';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';

    protected static ?string $navigationGroup = 'Operation Management';

    protected static ?string $navigationLabel = 'Kelola Desain';

    protected static ?int $navigationSort = 32;

    // public static function shouldRegisterNavigation(): bool
    // {
    //     $cekauth = auth()->user()->can('kelola_desain');

    //     if ($cekauth)
    //         return true;
    //     else
    //         return false;
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    // ->relationship('requestDesign', 'id')
                    ->schema([
                        TextInput::make(name: 'email')->required()->email()->rule(
                            fn ($record) => 'unique:request_designs,email,'
                                . ($record ? $record->id : 'NULL')
                                . ',id'
                        ),
                        Select::make('pilih_form')->searchable()->options([
                            'Banner/ads' => 'Form Request Banner/Ads',
                            'Microsite' => 'Form Request Microsite',
                            'Creative' => 'Form Request Creative',
                            'Ads Developer' => 'Form Request Ads Developer',
                        ])->preload(),
                        Select::make('designer')->searchable()->options([
                            'Mohon menunggu' => 'Mohon menunggu',
                            'Riyansyah' => 'Riyansyah',
                            'Naufal' => 'Naufal',
                            'Ferry' => 'Ferry',
                            'Erlangga' => 'Erlangga',
                            'Dimas' => 'Dimas',
                            'Rezza' => 'Rezza',
                            'Erick' => 'Erick',
                            'Gusthia' => 'Gusthia',
                            'Fuad' => 'Fuad',
                            'Yongki' => 'Yongki',
                            'Faiz' => 'Faiz',
                            'Indah' => 'Indah',
                            'Ayub' => 'Ayub',
                            'Rizqi' => 'Rizqi',
                            'Irfan' => 'Irfan',
                            'Qonita' => 'Qonita'
                        ])->preload(),
                        Select::make('brand')->required()
                            ->relationship('brand', 'brand')
                            ->options(Brand::all()->pluck('brand', 'brand'))
                            ->live()
                            ->label('Pilih Brand')
                            ->searchable()
                            ->preload()
                            ->placeholder('Cari Brand')
                            ->createOptionForm([
                                Forms\Components\TextInput::make(name: 'brand')
                                    ->required()
                                    ->label('Tambah Brand')
                                    ->maxLength(255),
                            ])
                            ->afterStateUpdated(fn ($state, Set $set) => $set('brand', Brand::find($state)?->brand ?? $state))
                            ->hiddenOn('edit'),
                        Select::make('tipe')
                            ->options([
                                'Request Baru' => 'Request Baru',
                                'Request Revisi' => 'Request Revisi',
                            ])->label('Tipe Request'),
                        Select::make('status')->options([
                            'Mohon menunggu' => 'Mohon menunggu',
                            'On Progress' => 'On Progress',
                            'Done' => 'Done',
                            'Revision' => 'Revision',
                            'Hold' => 'Hold',
                            'Cancel' => 'Cancel',
                            'Test' => 'Test',
                        ]),
                        MarkdownEditor::make('brief')->required(),
                        MarkdownEditor::make('materi')->required(),
                        MarkdownEditor::make('hasil')->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('brand')->sortable()->searchable()->label('Brand')->color('primary'),
                TextColumn::make('pilih_form')->sortable()->searchable()->label('Form')->color('primary'),
                TextColumn::make('tipe')->sortable()->searchable()->label('Tipe Request')
                    ->color(fn (string $state): string => match ($state) {
                        'Request Baru' => 'info',
                        'Request Revisi' => 'warning',
                    }),
                TextColumn::make('email')->sortable()->searchable()->color('primary'),
                TextColumn::make('designer')->sortable()->searchable()->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Mohon menunggu' => 'danger',
                        'Riyansyah' => 'info',
                        'Naufal' => 'info',
                        'Erlangga' => 'info',
                        'Ferry' => 'info',
                        'Dimas' => 'info',
                        'Rezza' => 'info',
                        'Erick' => 'info',
                        'Gusthia' => 'info',
                        'Fuad' => 'info',
                        'Yongki' => 'info',
                        'Faiz' => 'info',
                        'Indah' => 'info',
                        'Ayub' => 'info',
                        'Rizqi' => 'info',
                        'Irfan' => 'info',
                        'Qonita' => 'info'
                    }),
                TextColumn::make('status')->sortable()->searchable()->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Mohon menunggu' => 'danger',
                        'On progress' => 'warning',
                        'Done' => 'success',
                        'Revision' => 'success',
                        'Hold' => 'danger',
                        'Cancel' => 'danger',
                        'Test' => 'info',
                    }),
                TextColumn::make('created_at')->sortable()->searchable()->label('Dibuat Pada')
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->hidden()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    // ->successNotification(
                    //     Notification::make()
                    //         ->success()
                    //         ->title('Edit Berhasil')
                    //         ->body('Silahkan lihat update pada list'),
                    // ),
                    ->action(function ($data, $record) {
                        if ($record->requestDesign()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title(title: 'Edit Berhasil')
                                ->body(body: 'Silahkan lihat update pada list')
                                ->send();

                            return;
                        }

                        Notification::make()
                            ->success()
                            ->title(title: 'lead source deleted')
                            ->body(body: 'lead source has been deleted.')
                            ->send()
                            ->sendToDatabase(User::whereHas('roles', function ($query) {
                                $query->where('name', 'admin');
                            })->get());
                    }),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {
                        if ($record->requestDesign()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title(title: 'Data gagal dihapus')
                                ->body(body: 'Harap hapus request design terlebih dahulu')
                                ->send();

                            return;
                        }

                        Notification::make()
                            ->success()
                            ->title(title: 'Data Terhapus')
                            ->body(body: 'Data telah terhapus')
                            ->send()
                            ->sendToDatabase(User::whereHas('roles', function ($query) {
                                $query->where('name', 'admin');
                            })->get());

                        $record->delete();
                    })


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // TextEntry::make('brief')->markdown(),
                // TextEntry::make('result')->markdown()
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Brief')
                            ->schema([
                                TextEntry::make('brief')->markdown()->label('')
                            ])->label('Brief & Catatan dari pembuat request'),
                        Tabs\Tab::make('Hasil')
                            ->schema([
                                TextEntry::make('hasil')->markdown()->label('')
                            ])->label('Hasil'),
                        Tabs\Tab::make('Notes')
                            ->schema([
                                // ...
                            ])->label('Catatan dari designer'),
                    ])
            ])->columns(columns: 1);
    }


    public static function getRelations(): array
    {
        return [
            // RelationManagers\RequestDesignRelationManager::class,
            // RelationManagers\BrandRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResults::route('/'),
            'create' => Pages\CreateResult::route('/create'),
            // 'view' => Pages\ViewResult::route('/{record}'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
