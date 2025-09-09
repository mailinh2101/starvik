/**
 * Products Index Page JavaScript
 * Handles filtering, API calls, and user interactions
 */

class ProductsIndexPage {
    constructor() {
        this.init();
    }

    init() {
        this.loadCategories();
        this.loadBrands();
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Additional event listeners can be added here
        console.log('Products Index Page initialized');
    }

    loadCategories() {
        fetch('/api/categories')
            .then(response => response.json())
            .then(categories => {
                const select = document.querySelector('select[onchange="filterByCategory(this.value)"]');
                if (select) {
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category;
                        option.textContent = category.charAt(0).toUpperCase() + category.slice(1);
                        select.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading categories:', error);
            });
    }

    loadBrands() {
        fetch('/api/brands')
            .then(response => response.json())
            .then(brands => {
                const select = document.querySelector('select[onchange="filterByBrand(this.value)"]');
                if (select) {
                    brands.forEach(brand => {
                        const option = document.createElement('option');
                        option.value = brand;
                        option.textContent = brand;
                        select.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading brands:', error);
            });
    }
}

// Filter Functions
function filterByCategory(category) {
    if (category) {
        window.location.href = `/san-pham/danh-muc/${category}`;
    } else {
        // Get the products index route from meta tag or use fallback
        const baseUrl = document.querySelector('meta[name="app-url"]')?.content || '';
        window.location.href = baseUrl + '/san-pham';
    }
}

function filterByBrand(brand) {
    const url = new URL(window.location.href);
    if (brand) {
        url.searchParams.set('brand', brand);
    } else {
        url.searchParams.delete('brand');
    }
    window.location.href = url.toString();
}

function filterFeatured(checked) {
    const baseUrl = document.querySelector('meta[name="app-url"]')?.content || '';
    if (checked) {
        window.location.href = baseUrl + '/san-pham/noi-bat';
    } else {
        window.location.href = baseUrl + '/san-pham';
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new ProductsIndexPage();
});
