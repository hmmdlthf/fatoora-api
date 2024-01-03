$directoryPath = Read-Host -Prompt 'Enter path name (without the fatoora folder name in the path): '

# Step 1: Search for 'fatoora' directory
$fatooraPath = Get-ChildItem -Path $directoryPath -Filter "fatoora" -Recurse -Directory | Select-Object -First 1
Write-Host "Searched and got Fatoora folder: $($fatooraPath.FullName)"

# Step 2: Read and copy lines 14 to 17 from 'app/database/Db.php'
$dbFile = Get-Content -Path "$($fatooraPath.FullName)\app\database\Db.php" | Select-Object -Index (13..16) | Out-String
Write-Host "Copied Db lines $($dbFile)"

# Step 3: Read and copy the first line from 'js/config.js'
$configFile = Get-Content -Path "$($fatooraPath.FullName)\js\config.js" | Select-Object -First 1
Write-Host "Copied Config lines $($configFile)"

# Step 4: Delete 'fatoora' folder and contents
Remove-Item -Path $fatooraPath.FullName -Recurse -Force
Write-Host "Deleted Old fatoora folder"

# Step 5: Download the zip file
$download_url = 'https://github.com/hmmdlthf/fatoora-api.git'
Invoke-WebRequest -Uri $download_url -OutFile "$($directoryPath)\fatoora.zip"
Write-Host "Downloaded updated fatoora.zip folder"

# Step 6: Extract the downloaded zip file
Expand-Archive -Path "$($directoryPath)\fatoora.zip" -DestinationPath $fatooraPath.FullName
Write-Host "Extracted the zip"

# # Step 7: Replace lines in 'Db.php' and 'config.js' with copied content
# # Find the specific lines and replace them in Db.php
# $fileDb = "$($fatooraPath.FullName)\app\database\Db.php"
# $contentDb = Get-Content -Path $fileDb

# # Replace lines 14-17 in Db.php
# $contentDb[13..16] = $dbFile
# $contentDb | Set-Content -Path $fileDb

# # Find the specific line and replace it in config.js
# $fileConfig = "$($fatooraPath.FullName)\js\config.js"
# $contentConfig = Get-Content -Path $fileConfig

# # Replace the first line in config.js
# $contentConfig[0] = $configFile
# $contentConfig | Set-Content -Path $fileConfig

# Write-Host "Replaced the Db and Config lines with Machine values"