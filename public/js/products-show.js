/**
 * Products Show Page JavaScript
 * Handles gallery, sharing, and user interactions
 */

class ProductShowPage {
    constructor() {
        this.init();
    }

    init() {
        this.initializeGallery();
        this.setupEventListeners();
    }

    initializeGallery() {
        // Add zoom effect to main image
        const mainImage = document.getElementById('mainProductImage');
        if (mainImage) {
            mainImage.addEventListener('click', function() {
                window.open(this.src, '_blank');
            });
        }

        // Initialize thumbnails
        const thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const imageSrc = this.querySelector('img').src;
                changeMainImage(imageSrc, this);
            });
        });
    }

    setupEventListeners() {
        console.log('Product Show Page initialized');
    }
}

// Gallery Functions
function changeMainImage(imageSrc, thumbnail) {
    // Update main image
    const mainImage = document.getElementById('mainProductImage');
    if (mainImage) {
        mainImage.src = imageSrc;
    }

    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });

    if (thumbnail) {
        thumbnail.classList.add('active');
    }
}

// Contact Functions
function contactForProduct() {
    const productNameElement = document.querySelector('.product-title');
    const productName = productNameElement ? productNameElement.textContent.trim() : 'Sản phẩm';
    const message = `Tôi muốn tư vấn về sản phẩm: ${productName}`;
    const phone = "0123456789"; // Replace with your actual phone number
    const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}

// Share Functions
function shareProduct() {
    const productTitle = document.querySelector('.product-title')?.textContent || 'Sản phẩm';
    const productDescription = document.querySelector('.product-description')?.textContent?.substring(0, 100) || '';

    if (navigator.share) {
        navigator.share({
            title: productTitle,
            text: productDescription,
            url: window.location.href
        }).catch(error => {
            console.error('Error sharing:', error);
            fallbackShare();
        });
    } else {
        fallbackShare();
    }
}

function fallbackShare() {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link đã được sao chép vào clipboard!');
        }).catch(() => {
            promptCopyLink();
        });
    } else {
        promptCopyLink();
    }
}

function promptCopyLink() {
    const url = window.location.href;
    prompt('Sao chép link này:', url);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new ProductShowPage();
});
