// Script to update all HTML files to use centralized navigation
const fs = require('fs');
const path = require('path');

const filesToUpdate = [
  // IRP files
  'IRP/assets/about.html',
  'IRP/assets/contact.html', 
  'IRP/assets/hemis.html',
  'IRP/assets/insti_efficiency.html',
  'IRP/assets/news.html',
  'IRP/assets/stu.html',
  'IRP/index.html',
  
  // QMD files
  'QMD/assets/about.html',
  'QMD/assets/contact.html',
  'QMD/assets/news.html', 
  'QMD/assets/qual-ass.html',
  'QMD/assets/qual-enh.html',
  'QMD/assets/quality-promo.html',
  'QMD/assets/team.html',
  'QMD/index-qmd.html',
  
  // AcaPlan files
  'AcaPlan/assets/about.html',
  'AcaPlan/assets/academic_activity.html',
  'AcaPlan/assets/contact.html',
  'AcaPlan/assets/coordination_leadership.html',
  'AcaPlan/assets/news.html',
  'AcaPlan/assets/programme_development.html',
  'AcaPlan/assets/strategic_advisory.html',
  'AcaPlan/assets/team.html',
  'AcaPlan/assets/university_liaison.html',
  'AcaPlan/index.html'
];

function updateFile(filePath) {
  try {
    const fullPath = path.join(__dirname, filePath);
    let content = fs.readFileSync(fullPath, 'utf8');
    
    // Determine script path based on file location
    let scriptPath;
    if (filePath.includes('/assets/')) {
      scriptPath = '../../js/nav-config.js';
    } else if (filePath.includes('/IRP/') || filePath.includes('/QMD/') || filePath.includes('/AcaPlan/')) {
      scriptPath = '../js/nav-config.js';
    } else {
      scriptPath = './js/nav-config.js';
    }
    
    // Replace navigation section with centralized version
    const navRegex = /<section[^>]*>[\s\S]*?<script[^>]*load-nav\.js[^>]*><\/script>[\s\S]*?<\/header>[\s\S]*?<\/section>/i;
    const headerRegex = /<header[^>]*class="header"[^>]*>[\s\S]*?<\/header>/i;
    
    const newNavSection = `        <section class="nav-container">
            <script src="${scriptPath}"></script>
        </section>`;
    
    if (navRegex.test(content)) {
      content = content.replace(navRegex, newNavSection);
    } else if (headerRegex.test(content)) {
      content = content.replace(headerRegex, newNavSection);
    }
    
    fs.writeFileSync(fullPath, content, 'utf8');
    console.log(`Updated: ${filePath}`);
    
  } catch (error) {
    console.error(`Error updating ${filePath}:`, error.message);
  }
}

// Update all files
filesToUpdate.forEach(updateFile);
console.log('Navigation update complete!');