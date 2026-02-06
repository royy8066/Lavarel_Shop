// Product Image Magnifier Glass Functionality
class ProductImageMagnifier {
    constructor() {
        this.init();
    }

    init() {
        this.createLightbox();
        this.attachEventListeners();
    }

    createLightbox() {
        // Create lightbox if not exists
        if (!document.getElementById('imageLightbox')) {
            const lightbox = document.createElement('div');
            lightbox.id = 'imageLightbox';
            lightbox.className = 'image-lightbox';
            lightbox.innerHTML = `
                <button class="close-btn">&times;</button>
                <img src="" alt="Product Image">
            `;
            document.body.appendChild(lightbox);
        }
    }

    attachEventListeners() {
        // Product detail page magnifier
        const productImages = document.querySelectorAll('.product-image-zoom');
        productImages.forEach(container => {
            this.initMagnifier(container);
        });

        // Product list card zoom (keep simple hover)
        const productCards = document.querySelectorAll('.product-card .card-img-top');
        productCards.forEach(img => {
            img.addEventListener('click', (e) => this.openLightbox(e.target.src));
        });

        // Close lightbox
        const lightbox = document.getElementById('imageLightbox');
        const closeBtn = lightbox?.querySelector('.close-btn');
        
        closeBtn?.addEventListener('click', () => this.closeLightbox());
        lightbox?.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                this.closeLightbox();
            }
        });

        // ESC key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeLightbox();
            }
        });
    }

    initMagnifier(container) {
        const img = container.querySelector('img');
        if (!img) return;

        // Create lens and result elements
        const lens = document.createElement('div');
        lens.className = 'magnifier-lens';
        
        const result = document.createElement('div');
        result.className = 'magnifier-result';
        const resultImg = document.createElement('img');
        result.appendChild(resultImg);
        
        container.appendChild(lens);
        container.appendChild(result);

        // Set result image source
        resultImg.src = img.src;

        // Variables for magnifier
        let cx, cy, bw, bh, zx, zy;

        function initMagnifierVariables() {
            cx = result.offsetWidth / lens.offsetWidth;
            cy = result.offsetHeight / lens.offsetHeight;
            
            // Set background properties for result
            result.style.backgroundImage = `url('${img.src}')`;
            result.style.backgroundSize = `${img.width * cx}px ${img.height * cy}px`;
            
            bw = img.width;
            bh = img.height;
            zx = 2; // zoom level
            zy = 2;
        }

        function moveLens(e) {
            e.preventDefault();
            
            // Get cursor position
            const pos = getCursorPos(e);
            
            // Calculate position of lens
            let x = pos.x - (lens.offsetWidth / 2);
            let y = pos.y - (lens.offsetHeight / 2);
            
            // Prevent lens from being positioned outside the image
            if (x > img.width - lens.offsetWidth) { x = img.width - lens.offsetWidth; }
            if (x < 0) { x = 0; }
            if (y > img.height - lens.offsetHeight) { y = img.height - lens.offsetHeight; }
            if (y < 0) { y = 0; }
            
            // Set the position of the lens
            lens.style.left = x + 'px';
            lens.style.top = y + 'px';
            
            // Display what the lens "sees"
            result.style.backgroundPosition = `-${x * cx}px -${y * cy}px`;
        }

        function getCursorPos(e) {
            const rect = img.getBoundingClientRect();
            const x = e.pageX - rect.left - window.pageXOffset;
            const y = e.pageY - rect.top - window.pageYOffset;
            return {x: x, y: y};
        }

        // Initialize magnifier when image loads
        if (img.complete) {
            initMagnifierVariables();
        } else {
            img.addEventListener('load', initMagnifierVariables);
        }

        // Mouse events
        img.addEventListener('mouseenter', () => {
            if (window.innerWidth > 768) { // Only on desktop
                lens.style.display = 'block';
                result.style.display = 'block';
            }
        });

        img.addEventListener('mousemove', moveLens);
        
        img.addEventListener('mouseleave', () => {
            lens.style.display = 'none';
            result.style.display = 'none';
        });

        // Click to open lightbox
        img.addEventListener('click', () => this.openLightbox(img.src));
    }

    openLightbox(imageSrc) {
        const lightbox = document.getElementById('imageLightbox');
        const lightboxImg = lightbox?.querySelector('img');
        
        if (lightbox && lightboxImg) {
            lightboxImg.src = imageSrc;
            lightbox.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scroll
        }
    }

    closeLightbox() {
        const lightbox = document.getElementById('imageLightbox');
        if (lightbox) {
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scroll
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new ProductImageMagnifier();
});
