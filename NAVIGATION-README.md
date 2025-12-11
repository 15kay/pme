# Centralized Navigation System - PME Project

## Overview
This system eliminates code duplication by using a single JavaScript file to generate navigation across all sections of the PME project (IRP, QMD, AcaPlan).

## Files Created
- `js/nav-config.js` - Main navigation configuration
- `IRP/js/nav-config.js` - Copy for IRP section  
- `QMD/js/nav-config.js` - Copy for QMD section
- `AcaPlan/js/nav-config.js` - Copy for AcaPlan section

## How It Works
The NavigationManager class automatically:
1. Detects which section the current page is in
2. Calculates correct relative paths for all links
3. Generates appropriate navigation menus for each section
4. Highlights the current active page

## Implementation

### For HTML Files
Replace the entire navigation section with:

```html
<section class="nav-container">
    <script src="[PATH_TO_NAV_CONFIG]"></script>
</section>
```

### Path Reference Guide
- **Root level files** (index.html): `src="./js/nav-config.js"`
- **Section level files** (IRP/index.html): `src="../js/nav-config.js"`  
- **Assets level files** (IRP/assets/team.html): `src="../../js/nav-config.js"`

## Section-Specific Menus

### IRP Section
- Institutional Efficiency
- Student Tracking - Institutional Research  
- HEMIS
- Analytics & Business Intelligence

### QMD Section  
- Quality Assurance
- Quality Enhancement
- Quality Promotion

### AcaPlan Section
- Academic Activity
- Programme Development
- Coordination & Leadership
- Strategic Advisory
- University Liaison

## Files Already Updated
- `IRP/assets/team.html` ✅
- `IRP/assets/about.html` ✅

## Files That Need Manual Updates
All other HTML files in:
- `IRP/assets/` (contact.html, hemis.html, insti_efficiency.html, news.html, stu.html)
- `QMD/assets/` (all HTML files)
- `AcaPlan/assets/` (all HTML files)
- Root level index files

## Benefits
1. **DRY Principle**: Single source of truth for navigation
2. **Consistent Paths**: Automatic path calculation prevents broken links
3. **Easy Maintenance**: Update navigation in one place
4. **GitHub Pages Ready**: All paths work correctly for deployment
5. **Active State Management**: Automatic highlighting of current page

## GitHub Pages Deployment
All paths are calculated to work correctly when deployed to:
`https://15kay.github.io/pme/`

## Next Steps
1. Run `update-all-nav.bat` to copy files
2. Manually update remaining HTML files using the pattern shown
3. Test locally before pushing to GitHub
4. Deploy to GitHub Pages

## Troubleshooting
- If navigation doesn't appear, check the script path is correct
- If links are broken, verify the file structure matches the expected layout
- For new pages, ensure they follow the established directory structure