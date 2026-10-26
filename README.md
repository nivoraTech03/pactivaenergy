# PACTIVA ENERGY — Industrial B2B Energy & Power Solutions

High-Performance WordPress & WooCommerce Enterprise Platform for Lithium Battery Packs, Battery Energy Storage Systems (BESS), Solar Inverters, and High-Rate Discharge Cells.

---

## ⚡ Project Overview
- **Theme**: PACTIVA Energy Custom Theme (`wp-content/themes/pactiva-energy`)
- **Framework & Stack**: WordPress 6.x, WooCommerce, Tailwind CSS (Production Minified JIT), Vanilla JS, Swiper.js, Heroicons.
- **Key Features**:
  - High-conversion B2B Engineering RFQ & Instant WhatsApp Direct Routing.
  - Fail-safe Lead Generation (WordPress DB persistent backup + CSV/Excel Export in WP Admin).
  - CNC Quantity Stepper & Debounced Cart Synchronization.
  - Enterprise Security Headers (CSP, Clickjacking protection, Author enumeration guard).
  - Fully responsive from 320px mobile to 4K ultra-wide displays.

---

## 🛠️ Development & Build Tools

### Theme Path
```bash
cd wp-content/themes/pactiva-energy
```

### Install Dependencies
```bash
npm install
```

### Watch / Development Mode
```bash
npm run dev
```

### Production Minification & Build
```bash
npm run build
```

---

## 🔒 Security & Deployment Notes
- `wp-config.php` and user uploads are strictly excluded via `.gitignore`.
- Set database credentials on your production environment using `wp-config-sample.php`.
- Ensure directory permissions: `755` for directories and `644` for files.

---

© 2026 PACTIVA ENERGY TECH INDIA PVT LTD. All Rights Reserved.
