<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = '內容管理';
    protected static ?string $navigationLabel = '服務';
    protected static ?string $modelLabel = '服務';
    protected static ?string $pluralModelLabel = '服務';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('icon')
                    ->label('圖標')
                    ->required()
                    ->placeholder('fa-solid fa-house')
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('selectIcon')
                            ->label('選擇圖標')
                            ->url('https://fontawesome.com/search?o=r&m=free', true)
                            ->icon('heroicon-m-magnifying-glass')
                    )
                    ->afterStateUpdated(function ($state, Forms\Components\TextInput $component) {
                        if ($state) {
                            $component->helperText(new \Illuminate\Support\HtmlString("<i class='{$state}'></i> {$state}"));
                        }
                    })
                    ->dehydrateStateUsing(fn ($state) => str_replace(['fas ', 'far ', 'fab '], ['fa-solid ', 'fa-regular ', 'fa-brands '], $state))
                    ->helperText(fn ($state) => new \Illuminate\Support\HtmlString($state ? "<i class='{$state}'></i> {$state}" : '請輸入 Font Awesome 6 的圖標代碼，例如：fa-solid fa-house')),

                Forms\Components\TextInput::make('title')
                    ->label('標題')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('sub_title')
                    ->label('副標題')
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->label('啟用')
                    ->default(true),

                Forms\Components\TextInput::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('圖標')
                    ->html()
                    ->formatStateUsing(fn (string $state): string => "<i class='{$state}'></i>"),

                Tables\Columns\TextColumn::make('title')
                    ->label('標題')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sub_title')
                    ->label('副標題')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('啟用'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('排序')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新時間')
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
