/**
 * PACTIVA ENERGY — Core Vanilla JavaScript
 * High Performance, Zero Heavy Dependencies
 */

document.addEventListener('DOMContentLoaded', function () {
    initSecurityFrameBusting();
    initMobileNav();
    initLiveSearch();
    initEnquiryModal();
    initStickyHeader();
    initAddToCartFeedback();
    initQuantityButtons();
    initFlipkartImageZoom();
});

/**
 * Mobile Drawer Navigation
 */
function initMobileNav() {
    const toggleBtn = document.getElementById('pactiva-mobile-nav-toggle');
    const drawer = document.getElementById('pactiva-mobile-drawer');
    const backdrop = document.getElementById('pactiva-drawer-backdrop');
    const closeBtn = document.getElementById('pactiva-drawer-close');

    if (!toggleBtn || !drawer) return;

    function openDrawer() {
        drawer.classList.remove('-translate-x-full');
        if (backdrop) {
            backdrop.classList.remove('hidden');
            setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
        }
        document.body.classList.add('overflow-hidden');
    }

    function closeDrawer() {
        drawer.classList.add('-translate-x-full');
        if (backdrop) {
            backdrop.classList.add('opacity-0');
            setTimeout(() => backdrop.classList.add('hidden'), 300);
        }
        document.body.classList.remove('overflow-hidden');
    }

    toggleBtn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (backdrop) backdrop.addEventListener('click', closeDrawer);
}

/**
 * Live AJAX Product & SKU Search
 */
function initLiveSearch() {
    const searchInputs = document.querySelectorAll('.pactiva-live-search-input');
    
    searchInputs.forEach(input => {
        const container = input.closest('.pactiva-search-wrapper');
        if (!container) return;
        
        const dropdown = container.querySelector('.pactiva-search-results');
        let debounceTimer;

        input.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length < 2) {
                if (dropdown) dropdown.classList.add('hidden');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetchSearchResults(query, dropdown);
            }, 300);
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!container.contains(e.target) && dropdown) {
                dropdown.classList.add('hidden');
            }
        });
    });
}

function fetchSearchResults(query, dropdown) {
    if (!dropdown || !window.pactivaData) return;

    dropdown.classList.remove('hidden');
    dropdown.innerHTML = `
        <div class="p-4 text-center text-sm text-slate-500 flex items-center justify-center gap-2">
            <svg class="animate-spin h-4 w-4 text-brand-orange" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
            ${pactivaData.i18n.searching}
        </div>
    `;

    const formData = new FormData();
    formData.append('action', 'pactiva_live_search');
    formData.append('security', pactivaData.nonce);
    formData.append('query', query);

    fetch(pactivaData.ajaxUrl, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success && data.data.results && data.data.results.length > 0) {
            renderSearchResults(data.data.results, dropdown);
        } else {
            dropdown.innerHTML = `
                <div class="p-4 text-center text-xs text-slate-500">
                    ${pactivaData.i18n.noResults}
                </div>
            `;
        }
    })
    .catch(() => {
        dropdown.innerHTML = `
            <div class="p-3 text-center text-xs text-red-500">
                Failed to load results. Please try again.
            </div>
        `;
    });
}

function renderSearchResults(items, dropdown) {
    let html = '<div class="divide-y divide-slate-100 max-h-80 overflow-y-auto">';
    items.forEach(item => {
        html += `
            <a href="${item.permalink}" class="flex items-center gap-3 p-3 hover:bg-orange-50/50 transition-colors group">
                <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-contain bg-slate-50 rounded p-1 border border-slate-100">
                <div class="flex-1 min-w-0">
                    <div class="text-[10px] font-mono font-medium text-slate-400 uppercase tracking-wider">${item.sku}</div>
                    <div class="text-xs font-bold text-slate-900 group-hover:text-brand-orange truncate transition-colors">${item.name}</div>
                    <div class="text-xs font-black text-brand-orange mt-0.5">${item.price}</div>
                </div>
            </a>
        `;
    });
    html += '</div>';
    dropdown.innerHTML = html;
}

/**
 * Interactive Modal for B2B Quotations and Inquiries
 */
function initEnquiryModal() {
    const modal = document.getElementById('pactiva-enquiry-modal');
    if (!modal) return;

    const closeBtn = document.getElementById('pactiva-modal-close');
    const backdrop = document.getElementById('pactiva-modal-backdrop');
    const form = document.getElementById('pactiva-quote-form');

    function closeModal() {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (backdrop) backdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Form Submission
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            // Sync First Name + Last Name to 'name' hidden field
            const fnInput = document.getElementById('modal-first-name');
            const lnInput = document.getElementById('modal-last-name');
            const fullNameInput = document.getElementById('modal-full-name');
            if (fnInput && fullNameInput) {
                const ln = lnInput ? lnInput.value.trim() : '';
                fullNameInput.value = (fnInput.value.trim() + ' ' + ln).trim();
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const alertBox = document.getElementById('pactiva-form-status');
            const originalText = submitBtn ? submitBtn.innerHTML : 'Submit';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                    Submitting Quote Request...
                `;
            }

            const formData = new FormData(form);
            formData.append('action', 'pactiva_submit_enquiry');
            formData.append('security', pactivaData.nonce);

            fetch(pactivaData.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(response => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
                if (alertBox) {
                    alertBox.classList.remove('hidden');
                    if (response.success) {
                        alertBox.className = 'p-3 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200';
                        alertBox.innerHTML = response.data.message;
                        form.reset();
                        setTimeout(closeModal, 4000);
                    } else {
                        alertBox.className = 'p-3 rounded-lg text-xs font-semibold bg-red-50 text-red-800 border border-red-200';
                        alertBox.innerHTML = response.data.message || 'Submission failed. Please try again.';
                    }
                }
            })
            .catch(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
                if (alertBox) {
                    alertBox.classList.remove('hidden');
                    alertBox.className = 'p-3 rounded-lg text-xs font-semibold bg-red-50 text-red-800 border border-red-200';
                    alertBox.innerHTML = 'Network error. Please connect via WhatsApp directly.';
                }
            });
        });
    }
}

/**
 * Global function to open quote modal with prefilled product
 */
window.pactivaOpenEnquiryModal = function (productName, productSku) {
    const modal = document.getElementById('pactiva-enquiry-modal');
    if (!modal) return;

    const prodField = document.getElementById('modal-field-product');
    const skuField = document.getElementById('modal-field-sku');
    const titleSpan = document.getElementById('modal-product-title');
    const waLink = document.getElementById('modal-whatsapp-link');

    const displayName = productName || 'General Energy Storage Consultation';
    const displaySku = productSku || '';

    if (prodField) prodField.value = displayName;
    if (skuField) skuField.value = displaySku;
    if (titleSpan) {
        titleSpan.textContent = displaySku ? `${displayName} [SKU: ${displaySku}]` : displayName;
    }

    if (waLink && pactivaData && pactivaData.whatsappNumber) {
        const text = `Hello PACTIVA Energy Team, I need an official B2B technical quote for: *${displayName}* ${displaySku ? `(SKU: ${displaySku})` : ''}. Please share specs and wholesale pricing.`;
        waLink.href = `https://wa.me/${pactivaData.whatsappNumber}?text=${encodeURIComponent(text)}`;
    }

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    // Reset modal scroll to ensure title and header are always at top
    const modalScrollBody = modal.querySelector('.overflow-y-auto');
    if (modalScrollBody) {
        modalScrollBody.scrollTop = 0;
    }
};

/**
 * Sticky Header shadow and backdrop effect on scroll
 */
function initStickyHeader() {
    const header = document.getElementById('pactiva-site-header');
    if (!header) return;

    window.addEventListener('scroll', function () {
        if (window.scrollY > 20) {
            header.classList.add('shadow-md');
        } else {
            header.classList.remove('shadow-md');
        }
    }, { passive: true });
}

/**
 * WooCommerce AJAX Add to Cart Toast & UI Feedback (TOP Floating Popup)
 */
let pactivaCartToastTimer = null;

function initAddToCartFeedback() {
    if (typeof jQuery === 'undefined') return;

    jQuery(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {
        let productName = '';
        if ($button && $button.length) {
            $button.addClass('bg-emerald-600 hover:bg-emerald-700 text-white');
            const card = $button.closest('.pactiva-product-card, .product, article');
            if (card && card.length) {
                const titleEl = card.find('h2, h3, .pactiva-card-title, a[class*="line-clamp"], .woocommerce-loop-product__title');
                if (titleEl && titleEl.length) {
                    productName = titleEl.first().text().trim();
                }
            }
        }
        showCartToast(productName);
    });
}

function showCartToast(productName) {
    let toast = document.getElementById('pactiva-cart-toast');
    const cartUrl = (window.pactivaData && window.pactivaData.cartUrl) ? window.pactivaData.cartUrl : '/pactiva-energy/index.php/cart/';
    const themeUri = (window.pactivaData && window.pactivaData.themeUri) ? window.pactivaData.themeUri : '';
    const iconSrc = themeUri ? (themeUri + '/assets/images/pactiva-icon.png') : '';
    const itemTitle = productName || 'Item Added to Quotation';

    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'pactiva-cart-toast';
        // Positioned at the TOP CENTER with high z-index
        toast.className = 'fixed top-4 sm:top-6 left-1/2 -translate-x-1/2 z-[9999999] w-[94vw] max-w-md transform -translate-y-12 opacity-0 scale-95 transition-all duration-300 ease-out pointer-events-none';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        
        toast.innerHTML = `
            <div class="relative flex items-center gap-3 p-3.5 sm:p-4 bg-slate-950/95 backdrop-blur-xl text-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-brand-orange/40 ring-1 ring-white/10">
                <!-- Glowing Top Brand Accent Line -->
                <div class="absolute -top-px left-8 right-8 h-[2px] bg-gradient-to-r from-transparent via-brand-orange to-transparent"></div>

                <!-- Brand Emblem Icon -->
                <div class="w-10 h-10 rounded-xl bg-slate-900 border border-white/10 flex items-center justify-center shrink-0 overflow-hidden shadow-md">
                    ${iconSrc 
                        ? `<img src="${iconSrc}" alt="Pactiva Energy" class="w-full h-full object-cover">` 
                        : `<div class="w-7 h-7 rounded-lg bg-brand-orange flex items-center justify-center font-black text-white text-xs">✓</div>`
                    }
                </div>

                <!-- Info Column -->
                <div class="flex-1 min-w-0 pr-1">
                    <div class="flex items-center gap-1.5">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <p class="text-[10px] font-black uppercase tracking-wider text-emerald-400">Added to Cart / Quotation</p>
                    </div>
                    <p class="text-xs sm:text-sm font-bold text-white truncate pactiva-toast-item-name">${itemTitle}</p>
                    <p class="text-[10.5px] text-slate-400">Ready for WhatsApp dispatch</p>
                </div>

                <!-- Action CTA & Close Button -->
                <div class="flex items-center gap-1.5 shrink-0">
                    <a href="${cartUrl}" class="px-3.5 py-2 bg-gradient-to-r from-brand-orange to-brand-deep hover:brightness-110 text-white text-xs font-bold rounded-xl shadow-md shadow-orange-500/30 transition-all whitespace-nowrap active:scale-95">
                        View Cart &rarr;
                    </a>
                    <button type="button" id="pactiva-toast-close" class="p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-white/10 transition-colors" aria-label="Close notification">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(toast);

        // Close button listener
        const closeBtn = toast.querySelector('#pactiva-toast-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                hideCartToast();
            });
        }
    } else {
        const nameEl = toast.querySelector('.pactiva-toast-item-name');
        if (nameEl && productName) {
            nameEl.textContent = productName;
        }
    }

    if (pactivaCartToastTimer) {
        clearTimeout(pactivaCartToastTimer);
    }

    // Show popup from top
    requestAnimationFrame(() => {
        toast.classList.remove('-translate-y-12', 'opacity-0', 'scale-95', 'pointer-events-none');
        toast.classList.add('translate-y-0', 'opacity-100', 'scale-100', 'pointer-events-auto');
    });

    // Auto-dismiss after 4.5 seconds
    pactivaCartToastTimer = setTimeout(() => {
        hideCartToast();
    }, 4500);
}

function hideCartToast() {
    const toast = document.getElementById('pactiva-cart-toast');
    if (toast) {
        toast.classList.remove('translate-y-0', 'opacity-100', 'scale-100', 'pointer-events-auto');
        toast.classList.add('-translate-y-12', 'opacity-0', 'scale-95', 'pointer-events-none');
    }
}

/**
 * Clickjacking & Iframe Prevention (Frame-busting check)
 */
function initSecurityFrameBusting() {
    if (window.top !== window.self) {
        try {
            if (window.top.location.hostname !== window.self.location.hostname) {
                window.top.location = window.self.location.href;
            }
        } catch (e) {
            window.top.location = window.self.location.href;
        }
    }
}

/**
 * Interactive Quantity Stepper (+ / - buttons)
 */
function initQuantityButtons() {
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.pactiva-qty-btn');
        if (!btn) return;

        e.preventDefault();
        const group = btn.closest('.pactiva-quantity-group, .quantity');
        if (!group) return;

        const input = group.querySelector('input.qty, input[name="quantity"], .pactiva-qty-field');
        if (!input || input.disabled || input.readOnly) return;

        const isPlus = btn.classList.contains('pactiva-qty-plus') || btn.textContent.trim() === '+';
        const min = parseFloat(input.getAttribute('min')) || 1;
        const max = parseFloat(input.getAttribute('max')) || Infinity;
        const step = parseFloat(input.getAttribute('step')) || 1;
        let current = parseFloat(input.value) || min;

        if (isPlus) {
            current = Math.min(max, current + step);
        } else {
            current = Math.max(min, current - step);
        }

        input.value = current;

        // Trigger change & input events for WooCommerce cart update / AJAX
        input.dispatchEvent(new Event('input', { bubbles: true }));
        input.dispatchEvent(new Event('change', { bubbles: true }));

        // Enable WooCommerce cart update button if present
        const updateCartBtn = document.querySelector('button[name="update_cart"]');
        if (updateCartBtn) {
            updateCartBtn.disabled = false;
            updateCartBtn.removeAttribute('disabled');
        }
    });
}

/**
 * Flipkart-Style Product Image Zoom On Hover
 */
function initFlipkartImageZoom() {
    const container = document.getElementById('pactiva-zoom-container');
    const img = document.getElementById('pactiva-main-product-img');
    const hint = document.getElementById('pactiva-zoom-hint');
    if (!container || !img) return;

    let isHovering = false;

    container.addEventListener('mouseenter', function () {
        if (window.innerWidth < 768) return;
        isHovering = true;
        img.style.transition = 'transform 0.12s ease-out';
        if (hint) hint.style.opacity = '0';
    });

    container.addEventListener('mousemove', function (e) {
        if (!isHovering || window.innerWidth < 768) return;

        const rect = container.getBoundingClientRect();
        const x = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
        const y = Math.max(0, Math.min(100, ((e.clientY - rect.top) / rect.height) * 100));

        img.style.transformOrigin = `${x}% ${y}%`;
        img.style.transform = 'scale(2.2)';
    });

    container.addEventListener('mouseleave', function () {
        isHovering = false;
        img.style.transition = 'transform 0.25s ease-out, transform-origin 0.25s ease-out';
        img.style.transform = 'scale(1)';
        img.style.transformOrigin = 'center center';
        if (hint) hint.style.opacity = '1';
    });
}

/**
 * Gallery Thumbnail Switcher
 */
window.pactivaSwitchProductGalleryImage = function (newUrl, btn) {
    const mainImg = document.getElementById('pactiva-main-product-img');
    if (!mainImg || !newUrl) return;

    mainImg.style.opacity = '0.35';
    mainImg.style.transform = 'scale(1)';
    mainImg.style.transformOrigin = 'center center';

    const tempImg = new Image();
    tempImg.onload = function () {
        mainImg.src = newUrl;
        mainImg.style.opacity = '1';
    };
    tempImg.src = newUrl;

    const thumbs = document.querySelectorAll('.pactiva-thumb-btn');
    thumbs.forEach(t => {
        t.classList.remove('border-2', 'border-brand-orange');
        t.classList.add('border', 'border-slate-200');
    });
    if (btn) {
        btn.classList.remove('border', 'border-slate-200');
        btn.classList.add('border-2', 'border-brand-orange');
    }
};

/**
 * Universal Quantity Steppers (+ / -) & Seamless Cart Auto-Updater
 */
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.pactiva-qty-btn');
    if (!btn) return;
    
    const container = btn.closest('.pactiva-quantity-group') || btn.parentElement;
    if (!container) return;
    
    const input = container.querySelector('input.qty') || container.querySelector('input[type="number"]');
    if (!input) return;
    
    const currentVal = parseFloat(input.value) || 1;
    const min = parseFloat(input.getAttribute('min')) || 1;
    const max = parseFloat(input.getAttribute('max')) || 999999;
    const step = parseFloat(input.getAttribute('step')) || 1;
    
    if (btn.classList.contains('pactiva-qty-minus')) {
        if (currentVal > min) {
            input.value = Math.max(min, currentVal - step);
            input.dispatchEvent(new Event('change', { bubbles: true }));
        }
    } else if (btn.classList.contains('pactiva-qty-plus')) {
        if (currentVal < max) {
            input.value = currentVal + step;
            input.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }
});

// Auto-update cart whenever quantity changes (eliminates manual 'Update Quantities' button)
let pactivaCartUpdateTimer = null;
document.addEventListener('change', function(e) {
    if (e.target && e.target.matches('.woocommerce-cart-form input.qty')) {
        const updateBtn = document.querySelector('button[name="update_cart"]');
        if (updateBtn) {
            clearTimeout(pactivaCartUpdateTimer);
            updateBtn.disabled = false;
            pactivaCartUpdateTimer = setTimeout(() => {
                updateBtn.click();
            }, 600);
        }
    }
});

/**
 * WhatsApp Lead Click Logger (Automatic Background Database Backup)
 */
document.addEventListener('click', function(e) {
    const waLink = e.target.closest('a[href*="wa.me"]');
    if (!waLink) return;

    try {
        const urlObj = new URL(waLink.href);
        const textParam = urlObj.searchParams.get('text') || '';
        
        const card = waLink.closest('.pactiva-product-card');
        const prodTitle = card ? (card.querySelector('h3') ? card.querySelector('h3').innerText.trim() : '') : '';
        const prodSku = card ? (card.querySelector('strong') ? card.querySelector('strong').innerText.trim() : '') : '';

        const data = new FormData();
        data.append('action', 'pactiva_log_whatsapp_lead');
        data.append('product_name', prodTitle || document.title);
        data.append('product_sku', prodSku || 'WA-DIRECT');
        data.append('message', textParam);
        data.append('page_url', window.location.href);

        if (typeof pactivaData !== 'undefined' && pactivaData.ajaxUrl) {
            if (navigator.sendBeacon) {
                navigator.sendBeacon(pactivaData.ajaxUrl, data);
            } else {
                fetch(pactivaData.ajaxUrl, { method: 'POST', body: data, keepalive: true });
            }
        }
    } catch (err) {
        // Silently continue
    }
});
