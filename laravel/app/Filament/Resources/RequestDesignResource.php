<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Brand;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RequestDesign;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Route;
use Filament\Forms\Components\Section;
use Filament\Notifications\Collection;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\CreateAction;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RequestDesignResource\Pages;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\RequestDesignResource\RelationManagers;

class RequestDesignResource extends Resource
{
    protected static ?string $model = RequestDesign::class;

    protected static ?string $modelLabel = 'Request Design';

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Form';

    protected static ?string $navigationLabel = 'Request Desain';

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['id'] = auth()->id();

    //     return $data;
    // }

    public static function form(Form $form): Form
    {

        // $defaultRequestId = Route::current()->parameter('id');
        return $form
            ->schema([
                // Fieldset::make('Slahkan isi data berikut')
                //     ->relationship('result', 'id_request')
                //     ->schema([
                //         TextInput::make('id')->unique(ignorable: fn ($record) => $record)->hidden(),
                //         TextInput::make('email')->required()->email()->rule(
                //             fn ($record) => 'unique:request_designs,email,'
                //                 . ($record ? $record->id : 'NULL')
                //                 . ',id'
                //         )->maxLength(255)->default(''),
                //         Textarea::make('materi')->required(),
                //         MarkdownEditor::make('brief')->required(),
                //     ])

                Section::make('Selamat Datang di Design Smelter')
                    ->description('Silahkan isikan request design anda')
                    ->icon('heroicon-m-information-circle')
                    ->schema([
                        Fieldset::make('')
                            ->relationship('result', 'id_request')
                            ->live()
                            ->schema([
                                TextInput::make('id')->unique(ignorable: fn ($record) => $record)->hidden()->afterStateUpdated(function (?string $state, ?string $old) {
                                    $state()->update();
                                }),
                                TextInput::make('email')->required()->email()->rule(
                                    fn ($record) => 'unique:request_designs,email,'
                                        . ($record ? $record->id : 'NULL')
                                        . ',id'
                                )->maxLength(255),
                                Select::make('pilih_form')->searchable()->options([
                                    'Banner/ads' => 'Form Request Banner/ads',
                                    'Microsite' => 'Form Request Microsite',
                                    'Creative' => 'Form Request Creative',
                                    'Ads Developer' => 'Form Request Ads Developer',
                                ])->preload(),
                                Select::make('brand')->required()
                                    ->relationship('brand', 'brand')
                                    ->options(Brand::all()->pluck('brand', 'brand'))
                                    ->live()
                                    ->label('Pilih Brand')
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Cari Brand')
                                    // ->unique(ignorable: fn ($record) => $record)
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make(name: 'brand')
                                            ->required()
                                            ->label('Tambah Brand')
                                            ->maxLength(255)
                                            ->unique(ignorable: fn ($record) => $record),
                                    ])
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('brand', Brand::find($state)?->brand ?? $state)),
                                // ->afterStateUpdated(fn (Select $component) => $component
                                //     ->getContainer()
                                //     ->getComponent('brand')),
                                // ->options(function(callable $get){
                                //     $requestdesign = RequestDesign::find($get('id'));
                                //     if(!$requestdesign){
                                //         return [];
                                //     }
                                //     return $requestdesign->result()->pluck('brand', 'id');
                                // })
                                // ->options(function(callable $get){
                                //     $requestdesign = RequestDesign::find($get('id'));
                                //     if(!$requestdesign){
                                //         return [];
                                //     }
                                //     return $requestdesign->result()->pluck('brand', 'id');
                                // })->label('Pilih Brand')

                                Select::make('tipe')
                                    ->options([
                                        'Request Baru' => 'Request Baru',
                                        'Request Revisi' => 'Request Revisi',
                                    ])->label('Tipe Request')
                                    ->placeholder('Pilih Tipe'),
                                MarkdownEditor::make('brief')->required()->columnSpanFull()->label('Brief dan catatan'),
                                MarkdownEditor::make('materi')->required()->columnSpanFull(),
                            ])
                    ])


            ])->columns(columns: 1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('result.id')->sortable()->searchable()->label('Id')->disableClick(),
                TextColumn::make('result.brand')->sortable()->searchable()->label('Brand')->color('primary')->disableClick(),
                TextColumn::make('result.pilih_form')->sortable()->searchable()->label('Form')->disableClick(),
                TextColumn::make('result.tipe')->sortable()->searchable()->label('Tipe Request')->disableClick(),
                TextColumn::make('result.email')->sortable()->searchable()->label('Email')->color('primary')->disableClick(),
                TextColumn::make('result.designer')->sortable()->searchable()->label('Designer')
                    ->badge()
                    ->disableClick()
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
                TextColumn::make('result.status')->sortable()->searchable()->label('Status')
                    ->badge()
                    ->disableClick()
                    ->color(fn (string $state): string => match ($state) {
                        'Mohon menunggu' => 'danger',
                        'On progress' => 'warning',
                        'Done' => 'success',
                        'Revision' => 'success',
                        'Hold' => 'danger',
                        'Cancel' => 'danger',
                        'Test' => 'info',
                    }),
                TextColumn::make('created_at')->sortable()->searchable()->label('Dibuat Pada')->disableClick()

            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Edit Berhasil')
                        ->body('Silahkan lihat update pada list'),
                )->hidden(),
                Tables\Actions\DeleteAction::make(),
            ])
            // ->recordUrl(
            //     function ($record) {
            //         if ($record->trashed()) {
            //             return null;
            //         }
            //         return Pages\EditRequestDesign::getUrl([$record->id]);
            //     }
            // )
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
                                TextEntry::make('result.brief')->markdown()->label('')
                            ])->label('Brief & Catatan dari pembuat request'),
                        Tabs\Tab::make('Hasil')
                            ->schema([
                                TextEntry::make('result.hasil')->markdown()->label('')
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
            RelationManagers\ResultRelationManager::class,
            RelationManagers\BrandRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequestDesigns::route('/'),
            // 'create' => Pages\CreateRequestDesign::route('/create'),
            // 'view' => Pages\ViewRequestDesign::route('/{record}/view'),
            'edit' => Pages\EditRequestDesign::route('/{record}/edit'),
            'edito' => Pages\EditRequestDesign::route('/edito'),
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



    // protected function getActions(): array
    // {
    //     return [
    //         CreateAction::make()
    //             ->using(function (array $data, string $RequestDesign): RequestDesign {
    //                 return $RequestDesign::create($data);
    //             })
    //     ];
    // }
}
