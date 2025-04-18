<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Filament\Resources\AboutUsResource\RelationManagers;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = '內容管理';
    protected static ?string $navigationLabel = '關於我們';

    protected static ?string $modelLabel = '關於我們';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('基本資訊')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('標題'),
                        MarkdownEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('about-us/attachments')
                            ->label('內容'),
                        FileUpload::make('image')
                            ->image()
                            ->columnSpanFull()
                            ->imageEditor()
                            ->directory('about-us')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn($file): string => (string) str(Str::uuid7() . '.webp')
                            )
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);

                                $image->scale(1024);

                                $filename = Str::uuid7()->toString() . '.webp';

                                if (!file_exists(storage_path('app/public/about-us'))) {
                                    mkdir(storage_path('app/public/about-us'), 0755, true);
                                }

                                $image->toWebp(80)->save(storage_path('app/public/about-us/' . $filename));
                                return 'about-us/' . $filename;
                            })
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            })
                            ->label('圖片'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('啟用')
                            ->columnSpanFull()
                            ->inline(false)
                            ->default(true),
                    ]),
                Forms\Components\Section::make('SEO 設定')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(60)
                            ->label('Meta 標題')
                            ->helperText('建議長度：50-60 字元'),
                        Forms\Components\Textarea::make('meta_description')
                            ->maxLength(160)
                            ->label('Meta 描述')
                            ->helperText('建議長度：120-160 字元'),
                        FileUpload::make('meta_image')
                            ->image()
                            ->columnSpanFull()
                            ->imageEditor()
                            ->directory('about-us')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn($file): string => (string) str(Str::uuid7() . '.webp')
                            )
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);

                                $image->scale(1024);

                                $filename = Str::uuid7()->toString() . '.webp';

                                if (!file_exists(storage_path('app/public/about-us'))) {
                                    mkdir(storage_path('app/public/about-us'), 0755, true);
                                }

                                $image->toWebp(80)->save(storage_path('app/public/about-us/' . $filename));
                                return 'about-us/' . $filename;
                            })
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            })
                            ->label('Meta 圖片')
                            ->helperText('建議尺寸：1200x630 像素'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('標題'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('圖片'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('啟用'),
                Tables\Columns\TextColumn::make('meta_title')
                    ->searchable()
                    ->toggleable()
                    ->label('Meta 標題'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('建立時間'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('啟用狀態'),
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
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}
