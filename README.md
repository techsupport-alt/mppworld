# 84 Days Marathon Praise & Prayer (MPP) Website

A modern, responsive website for the 84-day Marathon Praise & Prayer movement - a nationwide prayer and worship initiative for spiritual transformation in Nigeria.

## 🌟 Overview

This website serves as the digital platform for the Marathon Praise & Prayer movement, providing:
- Prayer registration and time slot booking
- Volunteer registration and coordination
- Latest updates and testimonies
- Event information and resources
- Newsletter subscription
- Multi-language support preparation

## 🛠 Technology Stack

### Frontend
- **HTML5** - Semantic, accessible markup
- **CSS3** - Complete design system with CSS custom properties
- **Vanilla JavaScript (ES6+)** - Modular, component-based architecture
- **Lucide Icons** - Consistent iconography via CDN

### Backend
- **PHP 7.4+** - Server-side processing
- **MySQL** - Database management
- **RESTful APIs** - Form submissions and data handling

### Design System
- **CSS Custom Properties** - MMP brand colors (Orange #FF6600, Brown #8B4513, White #FFFFFF)
- **Responsive Design** - Mobile-first approach with proper breakpoints
- **Dark Mode Support** - Complete theme switching with white text hierarchy
- **Smooth Animations** - Scroll-triggered and hover effects with reduced motion support

## 📂 Project Structure (Clean Vanilla Implementation)

```
├── index.html                 # Main entry point (NO React dependencies)
├── css/
│   └── styles.css            # Complete production CSS (self-contained)
├── js/
│   ├── app.js                # Main application coordinator
│   ├── constants.js          # Static data and configuration
│   ├── utils.js              # Helper functions and utilities
│   └── components/           # Modular component functionality
│       ├── testimonials.js   # Testimonial slider component
│       ├── faq.js           # FAQ accordion component
│       └── forms.js         # Form handling and validation
├── backend/                  # PHP backend
│   ├── api/                 # API endpoints
│   │   ├── prayer-signup.php
│   │   └── volunteer-signup.php
│   ├── config/              # Database configuration
│   │   ├── database.php
│   │   └── email.php
│   ├── admin/               # Admin dashboard
│   │   ├── dashboard.php
│   │   ├── login.php
│   │   └── setup.php
│   ├── database/            # Database schema
│   │   └── schema.sql
│   └── DEPLOYMENT_GUIDE.md  # Backend deployment instructions
├── README.md                # Project documentation
├── deployment-checklist.md  # Complete deployment guide
├── design-framework.md      # Design system documentation
├── content-template.js      # Template for updating content
├── prepare-deployment.php   # Deployment preparation script
└── Attributions.md          # Third-party credits
```

## ✅ Fixed Issues

### Previous Problem
The project had **Tailwind CSS utility classes in HTML but no Tailwind CSS loaded**, causing broken styling.

### Solution Implemented
1. **Removed all React/TSX dependencies** - Pure vanilla implementation
2. **Replaced Tailwind classes** with proper CSS classes that exist in `styles.css`
3. **Self-contained styling** - No external CSS framework dependencies
4. **Complete responsive system** using CSS Grid and Flexbox
5. **Custom utility classes** for common patterns (spacing, colors, animations)

## 🚀 Quick Start

### 1. Local Development (Static Website)

```bash
# Clone the repository
git clone [repository-url]
cd mmp-website

# For basic static hosting - simply open index.html in a web browser
# OR use a local server for better development experience:

# Python
python -m http.server 8000

# PHP (if testing backend features)
php -S localhost:8000

# Node.js
npx serve .

# Then visit: http://localhost:8000
```

### 2. With Backend Features (Full-Stack)

```bash
# Set up database
mysql -u root -p < backend/database/schema.sql

# Configure database connection
cp backend/config/database.php.example backend/config/database.php
# Edit database.php with your credentials

# Set up admin user
php backend/admin/setup.php

# Start PHP server
php -S localhost:8000
```

## 🎨 Design System

### Brand Colors (From MMP Logo)
- **Primary Orange**: `#FF6600` - Call-to-action buttons, highlights
- **Secondary Brown**: `#8B4513` - Text accents, secondary elements  
- **Pure White**: `#FFFFFF` - Backgrounds, primary text (dark mode)
- **Charcoal**: `#1A1A1A` - Dark mode backgrounds

### Typography
- **Headings**: Montserrat (weights: 300-900)
- **Body Text**: Inter (weights: 300-700)
- **Logo**: Montserrat 800 weight

### CSS Class System
The project uses a custom CSS class system that provides:

```css
/* Layout Classes */
.container          /* Max-width container with auto margins */
.section-padding     /* Standard section spacing */
.text-center         /* Center text alignment */

/* Component Classes */
.btn                /* Base button styles */
.btn-primary        /* Orange primary button */
.btn-secondary      /* Outline button style */
.btn-brown          /* Brown secondary button */
.card               /* Base card component */
.form-input         /* Styled form inputs */

/* Animation Classes */
.fade-in            /* Fade in animation */
.fade-in-up         /* Fade in from bottom */
.fade-in-delay-*    /* Staggered animation delays */
.hover-lift         /* Hover lift effect */

/* Utility Classes */
.bg-muted           /* Muted background color */
.bg-gradient        /* Orange to brown gradient */
.font-heading       /* Montserrat font family */
.font-body          /* Inter font family */
```

## 📱 Features

### Core Functionality
- ✅ **Responsive Design** - Works perfectly on all device sizes
- ✅ **Dark Mode Toggle** - System preference detection + manual control with white text hierarchy
- ✅ **Prayer Registration** - Time slot booking with validation
- ✅ **Volunteer Signup** - Multi-step registration with area selection
- ✅ **Newsletter Subscription** - Email validation and success feedback
- ✅ **Testimonial Slider** - Auto-playing carousel with manual navigation
- ✅ **FAQ Accordion** - Expandable sections with smooth animations
- ✅ **Latest Updates** - Dynamic content grid with categorization
- ✅ **Smooth Animations** - Scroll-triggered fade-ins and hover effects

### Technical Features
- ✅ **Progressive Enhancement** - Core functionality works without JavaScript
- ✅ **Accessibility** - WCAG 2.1 AA compliant markup and interactions
- ✅ **SEO Optimized** - Semantic HTML, proper meta tags, structured data
- ✅ **Performance** - Optimized CSS, minimal dependencies, efficient animations
- ✅ **Cross-browser** - Tested on all modern browsers
- ✅ **Mobile-first** - Responsive breakpoints and touch-friendly interactions
- ✅ **No External Dependencies** - Self-contained CSS, only Lucide icons via CDN

## 🔧 Configuration

### JavaScript Configuration
Edit `js/constants.js` to customize application behavior:

```javascript
export const CONFIG = {
    TESTIMONIAL_AUTOPLAY_INTERVAL: 8000,  // Testimonial rotation time (ms)
    ANIMATION_DELAY_INCREMENT: 0.1,       // Staggered animation delays (s)
    NOTIFICATION_DURATION: 5000,          // Toast notification duration (ms)
    FORM_SIMULATION_DELAY: 1000,          // Form submission simulation (ms)
    DARK_MODE_STORAGE_KEY: 'mmp-dark-mode' // LocalStorage key for theme
};
```

### Content Customization
Update static content in `js/constants.js`:
- **TESTIMONIALS** - User testimonials for the slider
- **FAQS** - Frequently asked questions and answers
- **UPDATES** - Latest news and updates
- **NIGERIAN_STATES** - State options for forms
- **VOLUNTEER_AREAS** - Available volunteer opportunities

## 📋 API Endpoints

### Form Submission Endpoints (PHP Backend)
- `POST /backend/api/prayer-signup.php` - Prayer time slot registration
- `POST /backend/api/volunteer-signup.php` - Volunteer application submission

### Form Data Structures

**Prayer Registration:**
```json
{
    "name": "Full Name",
    "email": "user@example.com",
    "phone": "+234XXXXXXXXXX", 
    "state": "Lagos",
    "church": "Church Name (optional)",
    "prayer_time": "6am-9am",
    "commitment": "Prayer commitment message"
}
```

**Volunteer Registration:**
```json
{
    "name": "Full Name",
    "email": "volunteer@example.com",
    "phone": "+234XXXXXXXXXX",
    "state": "Abuja", 
    "areas": ["prayer_coordination", "social_media"],
    "experience": "Relevant experience description",
    "availability": "part_time"
}
```

## 🎯 Deployment

### Hostinger Deployment (Recommended)

**Complete deployment guide available in `deployment-checklist.md`**

1. **Database Setup**: Create database in PHPMyAdmin, import schema
2. **File Upload**: Upload all files to `public_html` directory
3. **Configuration**: Update database and email configuration files
4. **Testing**: Verify all forms and features work correctly

### Static Hosting (Frontend Only)
Deploy to any static hosting service for the frontend-only version:

**Netlify (Easiest):**
```bash
# Just drag and drop the project folder to netlify.com
# Or connect your Git repository for automatic deployments
```

**Vercel:**
```bash
npm i -g vercel
vercel --prod
```

**GitHub Pages:**
```bash
# Push to GitHub, enable Pages in repository settings
# Set source to main branch
```

### Production Checklist
- [ ] **Content Updates** - Replace placeholder content in `/js/constants.js`
- [ ] **Database Config** - Update `/backend/config/database.php`
- [ ] **Email Config** - Configure `/backend/config/email.php`
- [ ] **SSL Certificate** - Enable HTTPS
- [ ] **Form Testing** - Test all form submissions
- [ ] **Mobile Testing** - Real device testing
- [ ] **Performance Testing** - PageSpeed Insights, GTmetrix
- [ ] **Accessibility Testing** - Screen reader compatibility

## 🔍 Browser Support

### Minimum Requirements
- **Chrome**: 90+
- **Firefox**: 88+
- **Safari**: 14+
- **Edge**: 90+
- **Mobile Safari**: iOS 14+
- **Chrome Mobile**: Android 7+

### Progressive Enhancement Strategy
- **Core HTML/CSS** - Works in all browsers
- **Basic JavaScript** - Enhanced experience with ES6+ support
- **Advanced Features** - Graceful degradation for older browsers

## 📊 Performance Metrics

### Target Metrics
- **First Contentful Paint**: < 1.5s
- **Largest Contentful Paint**: < 2.5s
- **Cumulative Layout Shift**: < 0.1
- **First Input Delay**: < 100ms
- **Time to Interactive**: < 3.0s

### Optimization Features
- **Efficient CSS** - Custom properties, no unused styles
- **Modular JavaScript** - ES6 modules, tree-shaking ready
- **Optimized Images** - Responsive images, proper formats
- **Minimal Dependencies** - Only Lucide icons external
- **Smooth Animations** - CSS transforms, GPU acceleration

## 🤝 Contributing

### Development Guidelines
1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** changes (`git commit -m 'Add amazing feature'`)
4. **Test** thoroughly across browsers and devices
5. **Push** to branch (`git push origin feature/amazing-feature`)
6. **Submit** a Pull Request

### Code Standards
- **JavaScript**: ES6+ modules, clear naming conventions
- **CSS**: Mobile-first responsive design, semantic class names
- **HTML**: Accessible markup, proper semantic structure
- **Comments**: Comprehensive documentation for complex logic

## 🐛 Troubleshooting

### Common Issues

**Styling not working:**
- Verify `/css/styles.css` is loading properly
- Check browser console for CSS errors
- Ensure no Tailwind classes remain in HTML

**Forms not submitting:**
- Check browser console for JavaScript errors
- Verify backend API endpoints are accessible
- Test with network tab open to see request/response

**Dark mode not working:**
- Clear browser localStorage
- Check if `dark-mode-toggle` button exists
- Verify CSS custom properties are supported

**Animations not playing:**
- Check if `prefers-reduced-motion` is enabled
- Verify intersection observer support
- Test scroll triggering of animations

**Mobile layout issues:**
- Test viewport meta tag is present
- Check responsive breakpoints in CSS
- Verify touch interactions work properly

## 📞 Support

### Contact Information
- **Website**: https://marathonpraise.ng
- **Email**: info@marathonpraise.ng
- **Technical Support**: tech@marathonpraise.ng
- **Prayer Requests**: prayer@marathonpraise.ng

### Resources
- **Documentation**: This README and `design-framework.md`
- **Deployment Guide**: `deployment-checklist.md`
- **Content Template**: `content-template.js`
- **Backend Guide**: `/backend/DEPLOYMENT_GUIDE.md`

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Marathon Praise & Prayer Leadership** - Vision and spiritual direction
- **Design Contributors** - UI/UX design and brand identity
- **Development Team** - Implementation and quality assurance
- **Prayer Partners** - Spiritual support and feedback
- **Open Source Community** - Tools and inspiration

---

**Built with ❤️ and prayer for the transformation of Nigeria** 🇳🇬

*This is now a completely clean, vanilla HTML/CSS/JavaScript website with no React or Tailwind dependencies. Ready for deployment to any standard web hosting platform!*

**Last Updated: January 2025**