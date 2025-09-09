/**
 * Products Category Page JavaScript
 * Handles category-specific functionality
 */

class CategoryPage {
    constructor() {
        this.currentCategory = document.querySelector('[data-category]')?.dataset.category || '';
        this.init();
    }

    init() {
        this.loadRelatedCategories();
        this.initViewToggle();
        this.initSortFunctionality();
        this.restoreUserPreferences();
        this.bindEvents();
    }

    /**
     * Load related categories from API
     */
    loadRelatedCategories() {
        fetch('/api/categories')
            .then(response => response.json())
            .then(categories => {
                const container = document.getElementById('relatedCategories');
                if (!container) return;

                // Filter out current category
                const relatedCategories = categories.filter(cat => cat !== this.currentCategory);

                // Clear existing content
                container.innerHTML = '';

                // Add category tags
                relatedCategories.forEach(category => {
                    const link = document.createElement('a');
                    link.href = `/san-pham/danh-muc/${category}`;
                    link.className = 'category-tag';
                    link.textContent = this.capitalizeFirst(category);
                    container.appendChild(link);
                });
            })
            .catch(error => {
                console.error('Error loading categories:', error);
                // Fallback: show some default categories
                this.showDefaultCategories();
            });
    }

    /**
     * Show default categories if API fails
     */
    showDefaultCategories() {
        const container = document.getElementById('relatedCategories');
        if (!container) return;

        const defaultCategories = ['thực phẩm chức năng', 'đồ gia dụng', 'máy xay sinh tố', 'thiết bị y tế'];
        const filteredCategories = defaultCategories.filter(cat => cat !== this.currentCategory);

        filteredCategories.forEach(category => {
            const link = document.createElement('a');
            link.href = `/san-pham/danh-muc/${category}`;
            link.className = 'category-tag';
            link.textContent = this.capitalizeFirst(category);
            container.appendChild(link);
        });
    }

    /**
     * Initialize view toggle functionality
     */
    initViewToggle() {
        const viewButtons = document.querySelectorAll('.view-btn');
        viewButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const viewType = e.target.closest('.view-btn').dataset.view;
                this.toggleView(viewType);
            });
        });
    }

    /**
     * Toggle between grid and list view
     */
    toggleView(viewType) {
        const grid = document.getElementById('productGrid');
        const buttons = document.querySelectorAll('.view-btn');

        if (!grid) return;

        // Update active button
        buttons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.view === viewType) {
                btn.classList.add('active');
            }
        });

        // Update grid class
        if (viewType === 'list') {
            grid.classList.add('list-view');
        } else {
            grid.classList.remove('list-view');
        }

        // Save preference
        localStorage.setItem('productViewType', viewType);

        // Trigger custom event
        window.dispatchEvent(new CustomEvent('viewChanged', {
            detail: { viewType }
        }));
    }

    /**
     * Initialize sort functionality
     */
    initSortFunctionality() {
        const sortSelect = document.querySelector('.sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                this.sortProducts(e.target.value);
            });
        }
    }

    /**
     * Sort products based on selected option
     */
    sortProducts(sortType) {
        const url = new URL(window.location.href);

        if (sortType !== 'default') {
            url.searchParams.set('sort', sortType);
        } else {
            url.searchParams.delete('sort');
        }

        // Show loading state
        this.showLoadingState();

        // Navigate to sorted URL
        window.location.href = url.toString();
    }

    /**
     * Restore user preferences from localStorage
     */
    restoreUserPreferences() {
        // Restore view preference
        const savedView = localStorage.getItem('productViewType');
        if (savedView) {
            this.toggleView(savedView);
        }

        // Restore sort preference from URL
        const urlParams = new URLSearchParams(window.location.search);
        const sort = urlParams.get('sort');
        if (sort) {
            const sortSelect = document.querySelector('.sort-select');
            if (sortSelect) {
                sortSelect.value = sort;
            }
        }
    }

    /**
     * Bind additional events
     */
    bindEvents() {
        // Handle product card clicks for analytics
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (e.target.tagName !== 'A') return;

                const productName = card.querySelector('.product-title a')?.textContent;
                this.trackProductClick(productName);
            });
        });

        // Handle filter changes
        document.addEventListener('filterChanged', (e) => {
            this.handleFilterChange(e.detail);
        });

        // Handle scroll events for lazy loading (if needed)
        window.addEventListener('scroll', this.debounce(() => {
            this.handleScroll();
        }, 100));
    }

    /**
     * Show loading state
     */
    showLoadingState() {
        const grid = document.getElementById('productGrid');
        if (grid) {
            grid.style.opacity = '0.5';
            grid.style.pointerEvents = 'none';
        }

        // Add loading spinner if needed
        const loadingSpinner = document.createElement('div');
        loadingSpinner.className = 'loading-spinner';
        loadingSpinner.id = 'categoryLoading';
        document.body.appendChild(loadingSpinner);
    }

    /**
     * Hide loading state
     */
    hideLoadingState() {
        const grid = document.getElementById('productGrid');
        if (grid) {
            grid.style.opacity = '1';
            grid.style.pointerEvents = 'auto';
        }

        const spinner = document.getElementById('categoryLoading');
        if (spinner) {
            spinner.remove();
        }
    }

    /**
     * Handle filter changes
     */
    handleFilterChange(filterData) {
        console.log('Filter changed:', filterData);
        // Implement filter logic here
    }

    /**
     * Handle scroll events
     */
    handleScroll() {
        // Implement infinite scroll or other scroll-based features
        const scrollPosition = window.scrollY + window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        // Check if near bottom of page
        if (scrollPosition >= documentHeight - 100) {
            // Load more products if implementing infinite scroll
            this.loadMoreProducts();
        }
    }

    /**
     * Load more products (for infinite scroll)
     */
    loadMoreProducts() {
        // Implement infinite scroll loading
        console.log('Loading more products...');
    }

    /**
     * Track product clicks for analytics
     */
    trackProductClick(productName) {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'product_click', {
                'category': this.currentCategory,
                'product_name': productName,
                'page_location': window.location.href
            });
        }
    }

    /**
     * Utility function to capitalize first letter
     */
    capitalizeFirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    /**
     * Debounce function for performance
     */
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.categoryPage = new CategoryPage();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = CategoryPage;
}
