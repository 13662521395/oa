<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '山东柏瑞科技有限公司-管理员添加';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
      <li><a href="index.php?r=oaaffiche/index">首页</a>
      <li><a href="index.php?r=user/index">管理员</a>
      <li><a href="#">管理员添加</a>
    </ol>

   <div class="nav-search" id="nav-search">
        <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="icon-search nav-search-icon"></i>
                    </span>
        </form>
    </div><!-- 面包屑导航 -->

<div class="col-xs-12">
<div>

    
<div class="oa-user-form">

    <form id="w0" action="index.php?r=user/create" method="post">
<input type="hidden" name="oa_uid" value="">
    <div class="form-group field-oauser-oa_uname required">
<label class="control-label" for="oauser-oa_uname">用户名</label>
<input type="text" id="oauser-oa_uname"  placeholder="请输入用户名称" required="required" class="form-control" name="oa_uname" value="" maxlength="8" aria-required="true">

<div class="help-block"></div>
</div>
    <div class="form-group field-oauser-oa_pwd required">
<label class="control-label" for="oauser-oa_pwd">密码</label>
<input type="password" id="oauser-oa_pwd" placeholder="请输入密码" required="required" class="form-control" name="oa_pwd" value="" maxlength="25" aria-required="true">

<div class="help-block"></div>
</div>
    <div class="form-group field-oauser-oa_emil">
<label class="control-label" for="oauser-oa_emil">邮箱</label>
<input type="text" id="oauser-oa_emil" placeholder="请输入邮箱" required="required" class="form-control" name="oa_emil" value="" maxlength="20">

<div class="help-block"></div>
</div>
        <div class="form-group field-oauser-role_id required">
<label class="control-label">角色</label>
<div class="help-block"></div>
<div id="oarole-status"><label>
<?php foreach ($query1 as $query1) { ?>&nbsp;&nbsp;&nbsp;<input type="radio" name="role_id" value="<?php echo $query1['role_id'];?>">
 <?php echo $query1['role_name'];?>
<?php } ?></label></div>
</div> 
    <div class="form-group field-oauser-oa_status">
<label class="control-label">状态</label>
<div id="oauser-oa_status">
<label><input type="radio" name="oa_status" value="0"> 禁用</label>
<label><input type="radio" name="oa_status" checked="checked" value="1"> 正常</label></div>

<div class="help-block"></div>
</div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" style="border-radius: 10px">添加
        </button>    
    </div>

        <button class="btn" style="border-radius: 10px" type="reset">
            <i class="icon-undo bigger-110"></i>
            重置
        </button>
        <a class="btn" style="border-radius: 10px" href="index.php?r=role/index">
            <i class="icon-remove bigger-110"></i>
            返回
        </a>
    </form>
</div>

</div>
<!-- 右侧栏部位 -->
</div>
