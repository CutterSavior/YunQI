#!/bin/bash
# 安裝 Git 自動監控服務

echo "==== 安裝 Git 自動同步服務 ===="
echo ""

# 1. 安裝 inotify-tools（如果未安裝）
if ! command -v inotifywait &> /dev/null; then
    echo "安裝 inotify-tools..."
    yum install -y inotify-tools || apt-get install -y inotify-tools
fi

# 2. 建立監控腳本
cat > /usr/local/bin/yunqi-git-watch.sh << 'WATCHEOF'
#!/bin/bash
cd /www/wwwroot/YunQI

while true; do
    # 每 30 秒檢查一次遠端更新
    sleep 30
    
    # 獲取遠端最新提交
    git fetch origin main --quiet
    
    # 比較本地和遠端
    LOCAL=$(git rev-parse HEAD)
    REMOTE=$(git rev-parse origin/main)
    
    if [ "$LOCAL" != "$REMOTE" ]; then
        echo "[$(date)] 檢測到更新，開始同步..."
        
        # 拉取最新代碼
        git reset --hard origin/main
        
        # 清除快取
        rm -rf runtime/*
        
        # 重啟 PHP
        bt restart php
        
        echo "[$(date)] 同步完成"
    fi
done
WATCHEOF

chmod +x /usr/local/bin/yunqi-git-watch.sh

# 3. 建立 systemd 服務
cat > /etc/systemd/system/yunqi-git-watch.service << 'SERVICEEOF'
[Unit]
Description=YunQI Git Auto Pull Service
After=network.target

[Service]
Type=simple
User=root
WorkingDirectory=/www/wwwroot/YunQI
ExecStart=/usr/local/bin/yunqi-git-watch.sh
Restart=always
RestartSec=10

[Install]
WantedBy=multi-user.target
SERVICEEOF

# 4. 啟動服務
systemctl daemon-reload
systemctl enable yunqi-git-watch.service
systemctl start yunqi-git-watch.service

echo ""
echo "==== 安裝完成 ===="
echo "服務狀態："
systemctl status yunqi-git-watch.service --no-pager

echo ""
echo "==== 常用命令 ===="
echo "查看狀態: systemctl status yunqi-git-watch"
echo "停止服務: systemctl stop yunqi-git-watch"
echo "啟動服務: systemctl start yunqi-git-watch"
echo "重啟服務: systemctl restart yunqi-git-watch"
echo "查看日誌: journalctl -u yunqi-git-watch -f"

