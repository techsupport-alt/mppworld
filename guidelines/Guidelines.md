# 84 Days Marathon Praise & Prayer (MMP) - Development Guidelines

## Project Overview
This is a vanilla HTML/CSS/JavaScript website for the 84 Days Marathon Praise & Prayer movement - a nationwide spiritual awakening initiative for Nigeria. The website has been optimized for deployment on standard web hosting platforms like Hostinger.

## Technology Stack
- **Frontend**: Pure HTML5, CSS3, and vanilla JavaScript (ES6+)
- **Backend**: PHP 7.4+ with MySQL database
- **Styling**: Custom CSS with Tailwind-inspired utility classes
- **Icons**: Lucide icons via CDN
- **Fonts**: Google Fonts (Montserrat + Inter)

## Design System Guidelines

### Brand Colors (from MMP Logo)
- **Primary Orange**: `#FF6600` - Use for call-to-action buttons and highlights
- **Secondary Brown**: `#8B4513` - Use for secondary elements and warm accents  
- **Pure White**: `#FFFFFF` - Primary backgrounds and dark mode text
- **Charcoal**: `#1A1A1A` - Dark mode backgrounds

### Typography
- **Headings**: Montserrat (weights: 300-900) for impact and brand consistency
- **Body Text**: Inter (weights: 300-700) for readability and accessibility
- **Logo**: Montserrat 800 weight for brand recognition

### Component Patterns
- **Buttons**: Orange primary, brown secondary, rounded corners (8px)
- **Cards**: White backgrounds with subtle shadows, 12px border radius
- **Forms**: Clean inputs with orange focus states, proper label associations
- **Animations**: Smooth fade-ins and hover effects, respects `prefers-reduced-motion`

## Development Standards

### File Organization
```
├── index.html                 # Main entry point
├── css/styles.css            # Production CSS with complete design system
├── js/                       # Modular JavaScript components
│   ├── app.js                # Main application coordinator
│   ├── constants.js          # Static data and configuration
│   ├── utils.js              # Helper functions
│   └── components/           # Feature-specific modules
├── backend/                  # PHP backend with database integration
└── assets/                   # Images, favicons, etc.
```

### Code Quality
- **Semantic HTML**: Use proper HTML5 elements for accessibility
- **Progressive Enhancement**: Core functionality works without JavaScript
- **Mobile-First**: Responsive design starting from 320px screens
- **Accessibility**: WCAG 2.1 AA compliance, keyboard navigation, screen reader support
- **Performance**: Optimized images, minimal dependencies, efficient animations

### JavaScript Guidelines
- **ES6+ Modules**: Use import/export for clean code organization
- **Event Delegation**: Efficient event handling for dynamic content
- **Error Handling**: Graceful fallbacks for API failures
- **Local Storage**: Persist user preferences (dark mode, form progress)

### CSS Guidelines
- **Custom Properties**: Use CSS variables for consistent theming
- **Mobile-First**: Start with mobile styles, enhance for larger screens
- **Dark Mode**: Complete theme support with proper contrast ratios
- **Animation**: Smooth transitions, GPU-accelerated transforms

### PHP Backend Guidelines
- **Security**: Prepared statements, input validation, CSRF protection
- **Error Handling**: Proper HTTP status codes and error messages
- **Database**: Normalized schema, indexed queries, connection pooling
- **Email**: HTML templates, proper headers, delivery confirmation

## Content Guidelines

### Spiritual Focus
- **Prayer-Centered**: All content should direct users toward prayer and spiritual growth
- **Unity Emphasis**: Highlight the nationwide, unified nature of the movement
- **Transformation Focus**: Emphasize personal and national transformation through prayer
- **Biblical Foundation**: Include scripture references and spiritual encouragements

### Accessibility & Inclusion
- **Plain Language**: Use clear, simple language accessible to all education levels
- **Cultural Sensitivity**: Respect Nigeria's diverse religious and cultural landscape
- **Multi-Device**: Ensure equal experience across all devices and connection speeds
- **Multilingual Ready**: Design flexible for future translation to local languages

### Content Updates
- **Regular Refresh**: Keep testimonials, updates, and FAQs current
- **Real Data**: Use actual testimonials, events, and statistics
- **Contact Info**: Maintain accurate contact information and response systems
- **Prayer Points**: Update prayer focuses based on current national needs

## Deployment Checklist

### Pre-Deployment
- [ ] Update `/js/constants.js` with actual content (testimonials, FAQs, updates)
- [ ] Configure `/backend/config/database.php` with hosting database credentials
- [ ] Set up `/backend/config/email.php` with SMTP settings
- [ ] Test all forms and database connections locally
- [ ] Optimize images and assets for web delivery

### Hosting Setup (Hostinger)
- [ ] Create database and import `/backend/database/schema.sql`
- [ ] Upload all files to `public_html` directory
- [ ] Set proper file permissions (644 for files, 755 for directories)
- [ ] Test database connectivity via `/backend/config/database.php`
- [ ] Configure SSL certificate and force HTTPS redirects

### Post-Deployment Testing
- [ ] Test all forms (prayer signup, volunteer registration, newsletter)
- [ ] Verify email notifications are working
- [ ] Check dark mode functionality across browsers
- [ ] Test responsive design on actual mobile devices
- [ ] Run accessibility audit with screen reader
- [ ] Monitor performance with PageSpeed Insights

## Security Considerations

### Data Protection
- **No PII Collection**: Minimize personal information collection
- **Secure Transmission**: Always use HTTPS for form submissions
- **Data Retention**: Clear policies on how long data is stored
- **Privacy Compliance**: Follow applicable data protection regulations

### Technical Security
- **Input Validation**: Sanitize all user inputs on server-side
- **SQL Injection Prevention**: Use prepared statements exclusively
- **XSS Protection**: Escape output, use Content Security Policy
- **File Upload Security**: Validate file types and sizes if implementing uploads

## Performance Standards

### Target Metrics
- **First Contentful Paint**: < 1.5 seconds
- **Largest Contentful Paint**: < 2.5 seconds
- **Cumulative Layout Shift**: < 0.1
- **First Input Delay**: < 100ms

### Optimization Techniques
- **Image Optimization**: WebP format, responsive images, lazy loading
- **CSS Optimization**: Critical CSS inlined, non-critical CSS deferred
- **JavaScript Optimization**: ES6 modules, code splitting, tree shaking
- **Caching Strategy**: Proper cache headers, service worker for offline support

## Browser Support

### Minimum Requirements
- **Chrome**: 90+ (95%+ feature support)
- **Firefox**: 88+ (90%+ feature support)
- **Safari**: 14+ (90%+ feature support)
- **Edge**: 90+ (95%+ feature support)

### Progressive Enhancement
- **Core Experience**: Works without JavaScript in basic form
- **Enhanced Experience**: Full interactivity with modern browser features
- **Graceful Degradation**: Older browsers get simplified but functional experience

## Maintenance Guidelines

### Regular Tasks
- **Content Updates**: Review and refresh content monthly
- **Security Updates**: Keep PHP and dependencies updated
- **Performance Monitoring**: Monthly PageSpeed and accessibility audits
- **Backup Verification**: Test database and file backups regularly
- **Analytics Review**: Monitor user behavior and conversion rates

### Emergency Procedures
- **Downtime Response**: Clear communication channels and rollback procedures
- **Security Incidents**: Immediate response plan and user notification process
- **Data Recovery**: Tested backup restoration procedures
- **Contact Escalation**: Clear chain of responsibility for technical issues

---

**This website serves the sacred purpose of facilitating prayer and spiritual transformation across Nigeria. Every development decision should honor this calling while maintaining the highest standards of accessibility, security, and usability.**

*For the glory of God and the transformation of Nigeria* 🇳🇬✨