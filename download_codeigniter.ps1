$url = "https://github.com/codeigniter4/CodeIgniter4/archive/refs/tags/v4.4.6.zip"
$output = "codeigniter.zip"
$extractPath = "codeigniter"

# Download CodeIgniter
Invoke-WebRequest -Uri $url -OutFile $output

# Extract the zip file
Expand-Archive -Path $output -DestinationPath $extractPath -Force

# Copy files to the current directory
Copy-Item -Path "$extractPath\CodeIgniter4-4.4.6\*" -Destination "." -Recurse -Force

# Clean up
Remove-Item -Path $output, $extractPath -Recurse -Force
