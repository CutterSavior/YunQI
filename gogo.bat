@echo off
setlocal
set "ROOT=%~1"
if "%ROOT%"=="" set "ROOT=C:\Users\Ampli\Desktop\YunQI"

rem 如果存在 app001，優先使用 app001\app
set "APP=%ROOT%\app"
if exist "%ROOT%\app001\app" set "APP=%ROOT%\app001\app"

powershell -NoProfile -ExecutionPolicy Bypass -Command ^
  "$app='%APP%';" ^
  "New-Item -ItemType Directory -Force -Path \"$app\admin\controller\role\" >$null;" ^
  "New-Item -ItemType Directory -Force -Path \"$app\admin\view\role\guard\" >$null;" ^
  "$ctrl = @'<?php
declare(strict_types=1);
namespace app\admin\controller\role;
use app\common\controller\Backend;
use think\annotation\route\Group;
use think\annotation\route\Route;
#[Group(\"role/guard\")]
class Guard extends Backend{
    #[Route(\"GET,JSON\",\"index\")]
    public function index(){
        if(false === $this->request->isAjax()){
            return $this->fetch();
        }
        return json(['total'=>0,'rows'=>[]]);
    }
}
'@; Set-Content -Encoding UTF8 -NoNewline \"$app\admin\controller\role\Guard.php\" $ctrl;" ^
  "$wrong=\"$app\admin\controller\role\Guard\index.html\";" ^
  "$view =\"$app\admin\view\role\guard\index.html\";" ^
  "if(Test-Path $wrong){ Move-Item -Force $wrong $view } else { $html=@'
<template>
    <el-card shadow=\"never\">
        <yun-table :columns=\"columns\" toolbar=\"refresh\" :extend=\"extend\"></yun-table>
    </el-card>
</template>
<script>
    import table from \"@components/Table.js\";
    export default{
        components:{'YunTable':table},
        data:{ extend:{ index_url:'role/guard/index' }, columns:[ {checkbox:true},{field:'id',title:'ID'} ] }
    }
</script>
<style></style>
'@; Set-Content -Encoding UTF8 -NoNewline $view $html }" ^
  "if(Test-Path \"$env:ROOT\runtime\"){ Remove-Item \"$env:ROOT\runtime\*\" -Recurse -Force -ErrorAction SilentlyContinue }"

echo.
echo 已完成：控制器 Guard.php、視圖 role/guard/index.html、清理 runtime。
echo 菜單請填：\app\admin\controller\role\Guard / 方法：index / 類型：選項卡
endlocal