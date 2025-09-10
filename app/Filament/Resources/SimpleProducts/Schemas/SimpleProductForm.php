<?php

namespace App\Filament\Resources\SimpleProducts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Illuminate\Support\Str;

class SimpleProductForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                TextInput::make('name')
                    ->label('Tên sản phẩm')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->columnSpan(2),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('URL thân thiện cho sản phẩm')
                    ->columnSpan(2),

                Select::make('category')
                    ->label('Danh mục')
                    ->options([
                        'dien-tu' => 'Điện tử',
                        'gia-dung' => 'Gia dụng',
                        'my-pham' => 'Mỹ phẩm',
                        'y-te' => 'Y tế',
                        'khac' => 'Khác',
                    ])
                    ->searchable()
                    ->preload(),

                TextInput::make('brand')
                    ->label('Thương hiệu')
                    ->maxLength(255)
                    ->default('Perfekt'),

                RichEditor::make('description')
                    ->label('Mô tả')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'link',
                        'orderedList',
                        'strike',
                        'underline',
                    ]),

                KeyValue::make('specifications')
                    ->label('Thông số kỹ thuật')
                    ->keyLabel('Tên thuộc tính')
                    ->valueLabel('Giá trị')
                    ->reorderable()
                    ->addActionLabel('Thêm thông số')
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Ảnh chính')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->maxSize(5120) // 5MB
                    ->disk('public')
                    ->directory('products/main')
                    ->visibility('public'),

                FileUpload::make('gallery')
                    ->label('Thư viện ảnh')
                    ->multiple()
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->maxSize(5120) // 5MB
                    ->disk('public')
                    ->directory('products/gallery')
                    ->visibility('public')
                    ->maxFiles(10),

                Toggle::make('is_active')
                    ->label('Kích hoạt')
                    ->default(true),

                Toggle::make('is_featured')
                    ->label('Nổi bật')
                    ->default(false),

                TextInput::make('sort_order')
                    ->label('Thứ tự sắp xếp')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->columnSpan(2),

                TextInput::make('seo_title')
                    ->label('Tiêu đề SEO')
                    ->maxLength(60)
                    ->helperText('Tiêu đề hiển thị trên Google (tối đa 60 ký tự)')
                    ->columnSpan(2),

                Textarea::make('seo_description')
                    ->label('Mô tả SEO')
                    ->rows(3)
                    ->maxLength(160)
                    ->helperText('Mô tả hiển thị trên Google (tối đa 160 ký tự)')
                    ->columnSpanFull(),

                TextInput::make('seo_keywords')
                    ->label('Từ khóa SEO')
                    ->helperText('Các từ khóa cách nhau bằng dấu phẩy')
                    ->columnSpan(2),

                FileUpload::make('og_image')
                    ->label('Ảnh Open Graph')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->maxSize(5120) // 5MB
                    ->disk('public')
                    ->directory('products/og')
                    ->visibility('public')
                    ->helperText('Ảnh hiển thị khi chia sẻ trên mạng xã hội (1200x630px)')
                    ->columnSpan(2),
                    ])
            ]);
    }
}
