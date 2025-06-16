$phpPath = "php"
$projectPath = Get-Location

# Run the migration
& $phpPath "$projectPath\spark" migrate
