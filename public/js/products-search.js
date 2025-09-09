/**
 * Products Search Page JavaScript
 * Handles search highlighting, analytics, and user interactions
 */

class ProductSearchPage {
    constructor(searchTerm) {
        this.searchTerm = searchTerm;
        this.init();
    }

    init() {
        if (this.searchTerm && this.searchTerm.length > 2) {
            this.highlightSearchTerm();
        }
        this.trackSearch();
        this.setupEventListeners();
    }

    highlightSearchTerm() {
        const regex = new RegExp(`(${this.escapeRegex(this.searchTerm)})`, 'gi');
        const elements = document.querySelectorAll('.product-title, .product-description');

        elements.forEach(element => {
            const text = element.innerHTML;
            const highlighted = text.replace(regex, '<mark>$1</mark>');
            element.innerHTML = highlighted;
        });
    }

    escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    trackSearch() {
        try {
            // Google Analytics tracking
            if (typeof gtag !== 'undefined') {
                const resultsCount = document.querySelectorAll('.product-card').length;
                gtag('event', 'search', {
                    'search_term': this.searchTerm,
                    'search_results': resultsCount
                });
            }

            // Custom analytics can be added here
            this.logSearchEvent();
        } catch (error) {
            console.log('Analytics tracking error:', error);
        }
    }

    logSearchEvent() {
        // Custom search analytics
        const searchData = {
            term: this.searchTerm,
            timestamp: new Date().toISOString(),
            page: window.location.href,
            resultsCount: document.querySelectorAll('.product-card').length
        };

        console.log('Search Event:', searchData);

        // You can send this data to your analytics endpoint
        // fetch('/api/analytics/search', {
        //     method: 'POST',
        //     headers: { 'Content-Type': 'application/json' },
        //     body: JSON.stringify(searchData)
        // });
    }

    setupEventListeners() {
        // Track clicks on search results
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach((card, index) => {
            card.addEventListener('click', () => {
                this.trackResultClick(index);
            });
        });

        console.log('Product Search Page initialized');
    }

    trackResultClick(position) {
        try {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'select_content', {
                    'content_type': 'product',
                    'search_term': this.searchTerm,
                    'position': position + 1
                });
            }
        } catch (error) {
            console.log('Click tracking error:', error);
        }
    }
}

// Utility functions for search suggestions
function performNewSearch(term) {
    const searchUrl = `/tim-kiem?q=${encodeURIComponent(term)}`;
    window.location.href = searchUrl;
}

function clearSearch() {
    window.location.href = '/san-pham';
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get search term from meta tag or URL
    const searchTerm = getSearchTerm();
    new ProductSearchPage(searchTerm);
});

function getSearchTerm() {
    // Try to get search term from meta tag
    const metaSearchTerm = document.querySelector('meta[name="search-term"]');
    if (metaSearchTerm) {
        return metaSearchTerm.content;
    }

    // Fallback: extract from URL
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('q') || '';
}
