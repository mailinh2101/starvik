<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\SimpleProduct;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tổng tin tức', News::count())
                ->description('Tổng số bài viết tin tức')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Tin tức đã xuất bản', News::where('is_active', true)
                    ->where('published_at', '<=', now())
                    ->count())
                ->description('Bài viết đã được xuất bản')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Tổng sản phẩm', SimpleProduct::count())
                ->description('Tổng số sản phẩm')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning')
                ->chart([4, 3, 6, 8, 2, 5, 7, 4]),

            Stat::make('Sản phẩm kích hoạt', SimpleProduct::where('is_active', true)->count())
                ->description('Sản phẩm đang hiển thị')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Tin tức nổi bật', News::where('is_featured', true)->count())
                ->description('Bài viết được đánh dấu nổi bật')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Sản phẩm nổi bật', SimpleProduct::where('is_featured', true)->count())
                ->description('Sản phẩm được đánh dấu nổi bật')
                ->descriptionIcon('heroicon-m-star')
                ->color('info'),
        ];
    }
}
