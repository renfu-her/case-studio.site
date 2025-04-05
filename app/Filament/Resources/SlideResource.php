<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideResource\Pages;
use App\Filament\Resources\SlideResource\RelationManagers;
use App\Models\Slide;
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
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;

class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = '內容管理';

    protected static ?string $modelLabel = '輪播圖';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('標題'),
                FileUpload::make('image')
                    ->required()
                    ->columnSpanFull()
                    ->image()
                    ->imageEditor()
                    ->directory('slides')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->downloadable()
                    ->openable()
                    ->getUploadedFileNameForStorageUsing(
                        fn($file): string => (string) str(Str::uuid7() . '.webp')
                    )
                    ->saveUploadedFileUsing(function ($file) {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($file);
                        
                        $image->scale(2048);

                        $filename = Str::uuid7()->toString() . '.webp';

                        if (!file_exists(storage_path('app/public/slides'))) {
                            mkdir(storage_path('app/public/slides'), 0755, true);
                        }

                        $image->toWebp(80)->save(storage_path('app/public/slides/' . $filename));
                        return 'slides/' . $filename;
                    })
                    ->deleteUploadedFileUsing(function ($file) {
                        if ($file) {
                            Storage::disk('public')->delete($file);
                        }
                    })
                    ->label('圖片'),
                TinyEditor::make('description')
                    ->columnSpanFull()
                    ->minHeight(450)
                    ->label('描述'),
                Forms\Components\TextInput::make('link')
                    ->maxLength(255)
                    ->label('連結'),
                Forms\Components\Toggle::make('is_active')
                    ->label('啟用')
                    ->columnSpanFull()
                    ->inline(false)
                    ->default(true),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->label('排序'),
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
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('啟用'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable()
                    ->label('排序'),
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
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
