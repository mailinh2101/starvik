<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Ảnh')
                    ->circular()
                    ->size(50)
                    ->disk('public'),

                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                BadgeColumn::make('category')
                    ->label('Danh mục')
                    ->colors([
                        'primary' => 'tin-tuc',
                        'success' => 'su-kien',
                        'warning' => 'thong-bao',
                        'danger' => 'khuyen-mai',
                        'secondary' => 'blog',
                    ])
                    ->searchable(),

                TextColumn::make('author')
                    ->label('Tác giả')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('published_at')
                    ->label('Ngày xuất bản')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->description(fn ($record) => $record->published_at ? $record->published_at->format('d/m/Y H:i') : ''),

                IconColumn::make('published_status')
                    ->label('Đã xuất bản')
                    ->getStateUsing(fn ($record) => $record->published_at && $record->published_at <= now() && $record->is_active)
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean()
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Danh mục')
                    ->options([
                        'tin-tuc' => 'Tin tức',
                        'su-kien' => 'Sự kiện',
                        'thong-bao' => 'Thông báo',
                        'khuyen-mai' => 'Khuyến mãi',
                        'blog' => 'Blog',
                    ]),

                TernaryFilter::make('published_status')
                    ->label('Trạng thái xuất bản')
                    ->placeholder('Tất cả')
                    ->trueLabel('Đã xuất bản')
                    ->falseLabel('Chưa xuất bản')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_active', true)->where('published_at', '<=', now()),
                        false: fn (Builder $query) => $query->where(function ($q) {
                            $q->where('is_active', false)
                              ->orWhere('published_at', '>', now())
                              ->orWhereNull('published_at');
                        }),
                    ),

                TernaryFilter::make('is_featured')
                    ->label('Nổi bật')
                    ->placeholder('Tất cả')
                    ->trueLabel('Nổi bật')
                    ->falseLabel('Không nổi bật'),

                TernaryFilter::make('is_active')
                    ->label('Kích hoạt')
                    ->placeholder('Tất cả')
                    ->trueLabel('Đã kích hoạt')
                    ->falseLabel('Chưa kích hoạt'),

                Filter::make('published_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('published_from')
                            ->label('Từ ngày'),
                        \Filament\Forms\Components\DatePicker::make('published_until')
                            ->label('Đến ngày'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['published_from'] ?? null) {
                            $indicators[] = 'Từ ngày: ' . \Carbon\Carbon::parse($data['published_from'])->format('d/m/Y');
                        }
                        if ($data['published_until'] ?? null) {
                            $indicators[] = 'Đến ngày: ' . \Carbon\Carbon::parse($data['published_until'])->format('d/m/Y');
                        }
                        return $indicators;
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Xem')
                    ->url(fn ($record) => route('news.show', $record->slug))
                    ->openUrlInNewTab(),
                EditAction::make()
                    ->label('Sửa'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
                ]),
            ])
            ->defaultSort('published_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
