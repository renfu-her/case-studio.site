<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = '系統設定';

    protected static ?string $modelLabel = '設定';

    protected static ?int $navigationSort = 99;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('基本設定')
                            ->schema([
                                Forms\Components\TextInput::make('key')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->label('鍵值'),
                                Forms\Components\Select::make('group')
                                    ->options([
                                        'general' => '一般設定',
                                        'seo' => 'SEO設定',
                                        'social' => '社群媒體',
                                        'contact' => '聯絡資訊',
                                    ])
                                    ->required()
                                    ->label('群組'),
                                Forms\Components\Select::make('type')
                                    ->options([
                                        'text' => '文字',
                                        'textarea' => '多行文字',
                                        'rich_text' => '富文本',
                                        'image' => '圖片',
                                        'file' => '檔案',
                                    ])
                                    ->required()
                                    ->live()
                                    ->label('類型'),
                                Forms\Components\TextInput::make('label')
                                    ->required()
                                    ->label('標籤'),
                                Forms\Components\Textarea::make('description')
                                    ->label('描述'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('設定值')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('值')
                                    ->visible(fn (Forms\Get $get) => $get('type') === 'text'),
                                Forms\Components\Textarea::make('value')
                                    ->label('值')
                                    ->visible(fn (Forms\Get $get) => $get('type') === 'textarea'),
                                TinyEditor::make('value')
                                    ->label('值')
                                    ->visible(fn (Forms\Get $get) => $get('type') === 'rich_text'),
                                Forms\Components\FileUpload::make('value')
                                    ->label('值')
                                    ->image()
                                    ->imageEditor()
                                    ->visible(fn (Forms\Get $get) => $get('type') === 'image'),
                                Forms\Components\FileUpload::make('value')
                                    ->label('值')
                                    ->visible(fn (Forms\Get $get) => $get('type') === 'file'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->label('鍵值'),
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable()
                    ->label('標籤'),
                Tables\Columns\TextColumn::make('group')
                    ->searchable()
                    ->sortable()
                    ->label('群組'),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable()
                    ->label('類型'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('更新時間'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => '一般設定',
                        'seo' => 'SEO設定',
                        'social' => '社群媒體',
                        'contact' => '聯絡資訊',
                    ])
                    ->label('群組'),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
