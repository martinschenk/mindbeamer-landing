# MindBeamer Image Reference Guide

## Profile Images - Martin Schenk

### Available Sizes & Usage

#### Square Profile Images
- **100x100**: Thumbnails, comment avatars (3KB)
- **150x150**: Small profile displays (6KB)
- **200x200**: Navigation/header avatars (8KB)
- **300x300**: Medium profile sections (15KB)
- **400x400**: Standard website profile (23KB) ← **CURRENTLY USED**
- **600x600**: High-DPI/Retina displays (43KB)
- **800x800**: Large profile sections (68KB)
- **1024x1024**: Full resolution backup (105KB)

#### Social Media Formats
- **og-1200x630**: Open Graph/Facebook/LinkedIn sharing (65KB)

### Formats
- **.jpg**: Universal compatibility
- **.webp**: 20-30% smaller, modern browsers

### SEO-Optimized Naming Convention
`martin-schenk-founder-mindbeamer-[size].ext`

Benefits:
- Contains full name for search
- Includes role (founder)
- Includes company (mindbeamer)
- Size in filename for clarity

### Current Implementation
```html
<picture>
  <source srcset="400.webp 1x, 600.webp 2x, 800.webp 3x" type="image/webp">
  <source srcset="400.jpg 1x, 600.jpg 2x, 800.jpg 3x" type="image/jpeg">
  <img src="400.jpg" alt="Martin Schenk - Founder & CEO" width="400" height="400">
</picture>
```

### Usage Guidelines
- **Hero/Header**: Use 200x200 or 300x300
- **About Section**: Use 400x400 with responsive srcset
- **Testimonials**: Use 100x100 or 150x150
- **Social Sharing**: Use og-1200x630