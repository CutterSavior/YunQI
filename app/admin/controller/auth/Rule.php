<?php
/**
 * ----------------------------------------------------------------------------
 * 行到水穷处，坐看云起时
 * 开发软件，找贵阳云起信息科技，官网地址:https://www.56q7.com/
 * ----------------------------------------------------------------------------
 * Author: 老成
 * email：85556713@qq.com
 */
declare(strict_types=1);

namespace app\admin\controller\auth;

use app\common\controller\Backend;
use app\admin\traits\Actions;
use think\annotation\route\Route;
use think\annotation\route\Group;
use app\common\model\AuthRule;
use think\facade\Cache;
use think\facade\Db;

/**
 * 规则管理
 */
#[Group("auth/rule")]
class Rule extends Backend
{
    use Actions{
        add as private _add;
        edit as private _edit;
    }

    protected function _initialize()
    {
        parent::_initialize();
        $this->model = new AuthRule();
        Cache::delete('admin_rule_list');
        Cache::delete('admin_menu_list');
    }

    #[Route('GET,JSON','index')]
    public function index()
    {
        if (false === $this->request->isAjax()) {
            return $this->fetch();
        }
        $tree=AuthRule::getRuleListTree('*');
        $result = ['total' => 1000, 'rows' => $tree];
        return json($result);
    }

    #[Route('GET,POST','add')]
    public function add()
    {
        $this->beforeAction();
        if($this->request->isPost()){
            $isplatform=$this->request->post('row.isplatform');
            $ismenu=$this->request->post('row.ismenu');
            $title=$this->request->post('row.title');
            
            // 如果是頂部系統且為菜單，自動建立 platform 頁面
            if($isplatform && $ismenu && $title){
                $this->autoPlatformSetup($title);
            }
        }
        return $this->_add();
    }

    #[Route('GET,POST','edit')]
    public function edit()
    {
        $this->beforeAction();
        if($this->request->isPost()){
            $id=$this->request->post('row.id');
            $isplatform=$this->request->post('row.isplatform');
            $ismenu=$this->request->post('row.ismenu');
            $title=$this->request->post('row.title');
            $oldRule=AuthRule::find($id);
            
            // 如果改為頂部系統且為菜單，自動建立 platform 頁面
            if($isplatform && $ismenu && $title && (!$oldRule->isplatform || $oldRule->isplatform==0)){
                $this->autoPlatformSetup($title, $id);
            }
        }
        return $this->_edit();
    }

    /**
     * 自動設定頂部系統平台
     */
    private function autoPlatformSetup($platformName, $platformId = null)
    {
        try {
            // 1. 查找現有最大的 platform 編號
            $maxPlatform = Db::name('auth_rule')
                ->where('controller', 'like', '%Dashboard%')
                ->where('action', 'like', 'platform%')
                ->order('action', 'desc')
                ->value('action');
            
            $platformNum = 1;
            if($maxPlatform && preg_match('/platform(\d+)/', $maxPlatform, $matches)){
                $platformNum = intval($matches[1]) + 1;
            }
            
            $platformMethod = 'platform' . $platformNum;
            
            // 2. 建立控制器方法
            $controllerFile = app_path() . 'admin/controller/Dashboard.php';
            if(file_exists($controllerFile)){
                $content = file_get_contents($controllerFile);
                // 檢查方法是否已存在
                if(strpos($content, "public function {$platformMethod}()") === false){
                    // 在最後一個 } 前插入新方法
                    $newMethod = "\n    #[Route('GET','dashboard/{$platformMethod}')]\n";
                    $newMethod .= "    public function {$platformMethod}()\n";
                    $newMethod .= "    {\n";
                    $newMethod .= "        return \$this->fetch();\n";
                    $newMethod .= "    }\n";
                    
                    $content = preg_replace('/\n}\s*$/', $newMethod . "}\n", $content);
                    file_put_contents($controllerFile, $content);
                }
            }
            
            // 3. 建立視圖檔案
            $viewFile = app_path() . "admin/view/dashboard/{$platformMethod}.html";
            if(!file_exists($viewFile)){
                $viewContent = "<template>\n";
                $viewContent .= "    <el-card shadow=\"never\">\n";
                $viewContent .= "        <div style=\"text-align:center;padding:50px 0;\">\n";
                $viewContent .= "            <h1>{$platformName} - 控制台</h1>\n";
                $viewContent .= "            <p style=\"color:#999;margin-top:20px;\">歡迎來到{$platformName}管理平台</p>\n";
                $viewContent .= "        </div>\n";
                $viewContent .= "    </el-card>\n";
                $viewContent .= "</template>\n";
                $viewContent .= "<script>\n";
                $viewContent .= "    export default{\n";
                $viewContent .= "        data:{\n\n";
                $viewContent .= "        },\n";
                $viewContent .= "        methods: {\n\n";
                $viewContent .= "        }\n";
                $viewContent .= "    }\n";
                $viewContent .= "</script>\n";
                $viewContent .= "<style>\n\n";
                $viewContent .= "</style>\n";
                
                file_put_contents($viewFile, $viewContent);
            }
            
            // 4. 新增時自動建立首頁子菜單（編輯時不建立）
            if($platformId === null){
                // 先儲存父級菜單以獲取 ID
                // 這會在 _add() 執行後，透過回調處理
                $this->callback = function($rule) use ($platformMethod, $platformName) {
                    // 建立首頁子菜單
                    $homePage = new AuthRule();
                    $homePage->pid = $rule->id;
                    $homePage->title = '首頁';
                    $homePage->controller = '\\app\\admin\\controller\\Dashboard';
                    $homePage->action = $platformMethod;
                    $homePage->ismenu = 1;
                    $homePage->isplatform = 0;
                    $homePage->menutype = 'tab';
                    $homePage->icon = 'fa fa-home';
                    $homePage->extend = json_encode(['url'=>"dashboard/{$platformMethod}.html"]);
                    $homePage->status = 'normal';
                    $homePage->save();
                };
            }
            
        } catch (\Exception $e) {
            // 靜默失敗，不影響主流程
            trace('自動建立 platform 失敗: ' . $e->getMessage(), 'error');
        }
    }

    #[Route('GET,POST','del')]
    public function del()
    {
        $ids = $this->request->param("ids");
        $list = $this->model->where('id', 'in', $ids)->select();
        foreach ($list as $item) {
            $ins=AuthRule::where(['pid'=>$item->id,'ismenu'=>1])->count();
            if($ins>0){
                $this->error(__('请先删除【%s】的子菜单',['s'=>$item->title]));
            }
        }
        $count = 0;
        Db::startTrans();
        try {
            foreach ($list as $item) {
                AuthRule::where(['pid'=>$item->id])->delete();
                $count += $item->delete();
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }
        if ($count) {
            $this->success();
        }
        $this->error(__('没有记录被删除'));
    }

    private function beforeAction()
    {
        if(!$this->request->isPost()){
            $tree=AuthRule::getRuleListTree('*',true);
            $ruledata=array_merge(array([
                'id'=>'0',
                'title'=>__('无'),
                'childlist'=>[]
            ]),$tree);
            $this->assign('ruledata',$ruledata);
            $this->assign('menutypeList',AuthRule::menutypeList);
        }else{
            $ismenu=$this->request->post('row.ismenu');
            $controller=$this->request->post('row.controller');
            if($controller && !class_exists($controller)){
                $this->error(__('控制器不存在'));
            }
            if($ismenu){
                $action=$this->request->post('row.action');
                if($action){
                    if(!method_exists($controller,$action)){
                        $this->error(__('方法%s不存在',['s'=>$action]));
                    }
                }
            }else{
                $this->postParams['menutype']='';
                $this->postParams['icon']='';
                $this->postParams['extend']='';
                $this->postParams['status']='';
                $this->postParams['isplatform']=0;  // 規則不能是頂部系統
                $actions=$this->request->post('row.actions');
                if(!$actions){
                    $this->error(__('请填写方法列表'));
                }
                $actions=json_decode(htmlspecialchars_decode($actions),true);
                $title=[];
                $action=[];
                foreach ($actions as $key=>$value){
                    if(!method_exists($controller,$key)){
                        $this->error(__('方法%s不存在',['s'=>$key]));
                    }
                    $action[]=$key;
                    $title[]=$value;
                }
                $this->postParams['action']=json_encode($action,JSON_UNESCAPED_UNICODE);
                $this->postParams['title']=json_encode($title,JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
