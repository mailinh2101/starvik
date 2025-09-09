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
    
    // Create a modal or choice dialog
    const modal = createContactModal(productName);
    document.body.appendChild(modal);
    modal.style.display = 'block';
}

function createContactModal(productName) {
    const modal = document.createElement('div');
    modal.className = 'contact-modal';
    modal.innerHTML = `
        <div class="contact-modal-content">
            <div class="contact-modal-header">
                <h4>Liên hệ tư vấn sản phẩm</h4>
                <span class="contact-modal-close">&times;</span>
            </div>
            <div class="contact-modal-body">
                <p><strong>Sản phẩm:</strong> ${productName}</p>
                <p>Chọn cách liên hệ:</p>
                <div class="contact-options">
                    <button class="btn btn-success" onclick="callDirect()">
                        <i class="fas fa-phone"></i> Gọi ngay: 091 697 6795
                    </button>
                    <button class="btn btn-primary" onclick="contactWhatsApp('${productName}')">
                        <i class="fab fa-whatsapp"></i> Chat WhatsApp
                    </button>
                </div>
            </div>
        </div>
    `;

    // Add event listener for close button
    modal.querySelector('.contact-modal-close').addEventListener('click', function() {
        modal.remove();
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });

    return modal;
}

function callDirect() {
    const phone = "0916976795"; // Remove +84 and use local format
    window.location.href = `tel:${phone}`;
    // Close modal
    const modal = document.querySelector('.contact-modal');
    if (modal) modal.remove();
}

function contactWhatsApp(productName) {
    const message = `Tôi muốn tư vấn về sản phẩm: ${productName}`;
    const phone = "84916976795"; // International format for WhatsApp
    const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
    // Close modal
    const modal = document.querySelector('.contact-modal');
    if (modal) modal.remove();
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
