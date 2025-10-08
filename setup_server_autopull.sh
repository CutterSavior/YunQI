#!/bin/bash
# 寶塔伺服器 Git 自動同步設定腳本

echo "==== YunQI Git 自動同步設定 ===="
echo ""

# 1. 進入專案目錄
cd /www/wwwroot/YunQI || exit

# 2. 設定 Git 安全目錄
git config --global --add safe.directory /www/wwwroot/YunQI

# 3. 拉取最新代碼
echo "正在拉取最新代碼..."
git fetch origin main
git reset --hard origin/main

# 4. 清除快取
echo "清除快取..."
rm -rf runtime/*

# 5. 重啟 PHP
echo "重啟 PHP-FPM..."
bt restart php

echo ""
echo "==== 同步完成 ===="
echo "請重新整理後台查看最新功能"

