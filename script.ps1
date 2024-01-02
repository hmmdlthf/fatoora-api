$directoryPath = Read-Host -Prompt 'Enter path name (without the fatoora folder name in the path): '

# Step 1: Search for 'fatoora' directory
$fatooraPath = Get-ChildItem -Path $directoryPath -Filter "fatoora" -Recurse -Directory | Select-Object -First 1

# Step 2: Read and copy lines 14 to 17 from 'app/database/Db.php'
$dbFile = Get-Content -Path "$($fatooraPath.FullName)\app\database\Db.php" | Select-Object -Index (13..16) | Out-String

# Step 3: Read and copy the first line from 'js/config.js'
$configFile = Get-Content -Path "$($fatooraPath.FullName)\js\config.js" | Select-Object -First 1

# Use the user input in your script
# Write-Host "Directory Path: $directoryPath"
# Write-Host "DB Lines: $dbFile"
# Write-Host "Js Config Lines: $configFile"

# Step 4: Delete 'fatoora' folder and contents
Remove-Item -Path $fatooraPath.FullName -Recurse -Force

# Step 5: Download the zip file
$download_url = 'https://github.com/hmmdlthf/fatoora-api.git'
Invoke-WebRequest -Uri $download_url -OutFile "$env:TEMP\fatoora.zip"

# Step 6: Extract the downloaded zip file
Expand-Archive -Path "$env:TEMP\fatoora.zip" -DestinationPath $directoryPath

# Step 7: Replace lines in 'Db.php' and 'config.js' with copied content
# Set-Content -Path "$($fatooraPath.FullName)\app\database\Db.php" -Value $dbFile
# Set-Content -Path "$($fatooraPath.FullName)\js\config.js" -Value $configFile
