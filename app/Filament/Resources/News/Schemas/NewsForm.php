<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                TextInput::make('title')
                    ->label('Tiêu đề')
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
                    ->helperText('URL thân thiện cho bài viết')
                    ->columnSpan(2),

                Select::make('category')
                    ->label('Danh mục')
                    ->options([
                        'tin-tuc' => 'Tin tức',
                        'su-kien' => 'Sự kiện',
                        'thong-bao' => 'Thông báo',
                        'khuyen-mai' => 'Khuyến mãi',
                        'blog' => 'Blog',
                    ])
                    ->searchable()
                    ->preload(),

                TextInput::make('author')
                    ->label('Tác giả')
                    ->default(auth()->user()->name ?? 'Admin'),

                DateTimePicker::make('published_at')
                    ->label('Ngày xuất bản')
                    ->default(now())
                    ->native(false)
                    ->columnSpan(2),

                Textarea::make('excerpt')
                    ->label('Tóm tắt')
                    ->rows(3)
                    ->maxLength(500)
                    ->helperText('Mô tả ngắn gọn về bài viết (tối đa 500 ký tự)')
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Nội dung')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),

                TagsInput::make('tags')
                    ->label('Thẻ tag')
                    ->separator(',')
                    ->suggestions([
                        'tin-tuc',
                        'su-kien',
                        'thong-bao',
                        'blog',
                        'khuyen-mai',
                        'san-pham',
                        'dich-vu',
                    ])
                    ->columnSpanFull(),

                FileUpload::make('featured_image')
                    ->label('Ảnh đại diện')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->maxSize(5120) // 5MB
                    ->disk('public')
                    ->directory('news/featured')
                    ->visibility('public'),

                FileUpload::make('gallery')
                    ->label('Thư viện ảnh')
                    ->multiple()
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->maxSize(5120) // 5MB
                    ->disk('public')
                    ->directory('news/gallery')
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
                    ->directory('news/og')
                    ->visibility('public')
                    ->helperText('Ảnh hiển thị khi chia sẻ trên mạng xã hội (1200x630px)')
                    ->columnSpan(2),
                    ])
            ]);
    }
}
