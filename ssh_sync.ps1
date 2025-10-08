# SSH Sync to Baota Server
param(
    [string]$ServerIP = "admin.andy123.net",
    [string]$Username = "root",
    [string]$ProjectPath = "/www/wwwroot/YunQI"
)

Write-Host "==== SSH Sync to Baota ====" -ForegroundColor Green
Write-Host "Server: $Username@$ServerIP" -ForegroundColor Cyan
Write-Host "Project Path: $ProjectPath" -ForegroundColor Cyan
Write-Host ""

# Create SSH key file
$SSHKeyPath = ".\ssh_key"
if (-not (Test-Path $SSHKeyPath)) {
    Write-Host "Creating SSH key file..." -ForegroundColor Yellow
    $SSHKeyContent = @"
-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAwX+fFqqLKBsbBMf+faUvURvGvHWLrZ2XCiThi6VXrfLu5H2W
2qEdSW6mmogD0Yguq5b4ndoiL/BOC+MkdiXDOY54Bkia9mQiIS4LAMjZMJTzZ/AQ
gwHrcawQCYH09i2Cj00Mwf0FdSfpeXxDC4T1wkQTRGOtwh0Ufur/BOWp1R519kdp
3VvN2krPDZZFe1cpfR4+hpndODnpSWTqTd8McGAihoU6+GyUa2rnZMckA2E52Pzd
URTeou8ZPoAlVL71X3Mq9M89qxBlxkTu7+9BuVchL3RsYKWuduXaj5lCenTV+Ez9
9JyZcj+rNDoTPSPPHffswWWscPVAjkGmF2DUSwIDAQABAoIBAAD6LwiDRf6m3GUS
yYNC8VE8ja1n/pOa5ydi9kypQh8byf8Xb0qdY7N6PpcrNrG5OVsegRTzBBcv5IUE
2atLF4hT4uFNPpMeAFogjGetnAM1zWDqAntW6CSD1PTnViBkLHOi1Pyp1Xw4/mHh
scj+G+umQl6nDjqbwP2/HBifPFNaOMd/pr2qTK63WwpzPdRlYFH4bM081xmb9Ve2
KIJC0B2nt0ipcPM2p3QhE04VM0E/iFYikqAq0yT98Rxl7huSngGwSxJ5Yf2UOT/P
qQlXXgL0rU9h9PFIl/ZPzZYDH7DzYI7xQPwvUv12gxysFMrfJQlpuEfdQCbEHzqJ
RTEMIQECgYEA7chROdwCDZG2Kax/ncIK/r39bEk7PstaXoX/feCsdm2Nf1c4KdJu
0su+ERCvdzYYV/vl90+u+Z8qasAkSOixR8+OS0/FG0vVnwrTcF50hoY6QS4pOtkG
rWCBndzrYgj3tRSPpAomOKO1sN4i9lOaIngtW/iZRdUmWwPjX5juTcsCgYEA0FLA
ov/Fwpdwe8Pd+sJrUrItX0MPeC4ud67macg2KV79OO9SAfJ6iI8GN6gA/B3iVuf8
yZcXieTD1CC+d31IAmar03MwchAs/NghLVvNNrIxjTQh83iC+Kczl1SME25XnGN/
iME7dqCE5InCc5IwzXkfGsYROPbcDHm9naTew4ECgYBW9+dNhDxz/hFkWKUsbCZd
Wdvw2TAEHZhl7hiuT5iEkDkqlBoEoeTK0J4p27JxpaVtuMI5nDlhL2fyN2iOCh2d
KDrhLMHo4+m0C9+dv85azYlNAbcuwOYCT8PYm060Qpdm8ag/1T55hNcVY4niEl3T
saTVeK2GrxkiPN/SvTqb1QKBgHo4stBu42XBV7slNS0Tt8eyxa/oNkE6RwTs1j4l
urEXC9XFgwWlb4KC9xDcPoesOMjoHoVfYe4DC2l/NIACPqc5+YF7SWcCWoKVgxGL
lKCMd0ny1iB0CdM8taYJco1L5ZbZQU/InsyAbLdwo2cO1BcZAsjAgAY9vuiK3FaL
Di8BAoGBAIhrLXt/6KbHftk2/l68PI20ZgWqIF7A2vMFhnYduoBQ3H85+SF7seMP
HmD+ZmBvb/CkzLDtCFTwDmFLVxawOqGBDaK+LxZ5BTOzf1CVQQU5N0zgOfpd+qrC
fvI3l7uoFt6jtXzaDjFlVi24/B98JbgdyV/3qLShbKktcIjCGb4V
-----END RSA PRIVATE KEY-----
"@
    $SSHKeyContent | Out-File -FilePath $SSHKeyPath -Encoding ASCII
    Write-Host "SSH key file created" -ForegroundColor Green
}

# Sync commands
$SyncCommands = "cd $ProjectPath; git pull origin main; rm -rf runtime/*; bt restart php; echo '==== Sync Complete ===='"

Write-Host "Executing sync..." -ForegroundColor Yellow
Write-Host ""

try {
    # Execute SSH sync
    ssh -i "$SSHKeyPath" -o StrictHostKeyChecking=no "$Username@$ServerIP" "$SyncCommands"
    
    Write-Host ""
    Write-Host "==== Sync Complete ====" -ForegroundColor Green
    Write-Host "Server updated to latest version!" -ForegroundColor Green
    
} catch {
    Write-Host "SSH sync failed: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host ""
    Write-Host "Please check:" -ForegroundColor Yellow
    Write-Host "1. Server IP is correct" -ForegroundColor Yellow
    Write-Host "2. SSH key is correct" -ForegroundColor Yellow
    Write-Host "3. Server allows SSH connection" -ForegroundColor Yellow
    Write-Host "4. Firewall allows port 22" -ForegroundColor Yellow
}

Write-Host ""
Read-Host "Press Enter to exit"

