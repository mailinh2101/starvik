<?php

namespace App\Filament\Resources\SimpleProducts\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class SimpleProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Ảnh')
                    ->circular()
                    ->size(50)
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 40) {
                            return null;
                        }
                        return $state;
                    }),

                BadgeColumn::make('category')
                    ->label('Danh mục')
                    ->colors([
                        'primary' => 'dien-tu',
                        'success' => 'thoi-trang',
                        'warning' => 'gia-dung',
                        'danger' => 'my-pham',
                        'secondary' => 'sach',
                        'info' => 'the-thao',
                        'gray' => 'khac',
                    ])
                    ->searchable(),

                TextColumn::make('brand')
                    ->label('Thương hiệu')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

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
                        'dien-tu' => 'Điện tử',
                        'thoi-trang' => 'Thời trang',
                        'gia-dung' => 'Gia dụng',
                        'my-pham' => 'Mỹ phẩm',
                        'sach' => 'Sách',
                        'the-thao' => 'Thể thao',
                        'khac' => 'Khác',
                    ]),

                SelectFilter::make('brand')
                    ->label('Thương hiệu')
                    ->options(function () {
                        return \App\Models\SimpleProduct::distinct()
                            ->whereNotNull('brand')
                            ->pluck('brand', 'brand')
                            ->toArray();
                    })
                    ->searchable(),

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
            ])
            ->actions([
                ViewAction::make()
                    ->label('Xem')
                    ->url(fn ($record) => route('products.show', $record->slug))
                    ->openUrlInNewTab(),
                EditAction::make()
                    ->label('Sửa'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
