@echo off
echo Updating navigation across all HTML files...

REM Copy the nav-config.js to all js directories
copy "js\nav-config.js" "IRP\js\nav-config.js" /Y
copy "js\nav-config.js" "QMD\js\nav-config.js" /Y  
copy "js\nav-config.js" "AcaPlan\js\nav-config.js" /Y

echo Navigation files copied successfully!
echo.
echo Manual updates needed for HTML files:
echo 1. Replace navigation sections with: ^<section class="nav-container"^>^<script src="../../js/nav-config.js"^>^</script^>^</section^>
echo 2. For root level files use: ^<script src="./js/nav-config.js"^>
echo 3. For section level files use: ^<script src="../js/nav-config.js"^>
echo 4. For assets level files use: ^<script src="../../js/nav-config.js"^>
echo.
pause