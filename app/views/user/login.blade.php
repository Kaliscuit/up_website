<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <title>用户注册</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://dn-up.qbox.me/css/up.main.css">
    <link rel="stylesheet" href="http://dn-up.qbox.me/css/user/regist.css">
    <script src="http://dn-up.qbox.me/js/comm/jquery-1.10.2.js"></script>
    <script src="http://dn-up.qbox.me/js/comm/jquery.placeholder.js"></script>     
    <!--[if lt IE 9]>      
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>           
    <![endif]-->
  </head>
  <body>
  <div class="container">
    <header id="header" class="">
      <div class="header_l">
        <span><a href="javascript:void(0);" title="返回">← 返回首页</a></span>
      </div>
      <div class="header_r">
        <span>还没有账号吗？ <a href="javascript:void(0);" title="注册" class="btn">注册</a></span>
      </div>
    </header>

    <section id="section">
      <div class="logo col-xs-16">       
        <img src="http://dn-up.qbox.me/img/user/logo.png" alt="logo" class="margin_btn_100">
      </div>
      <div class="regist_d col-xs-16">
        <div class="regist_d_sub">
          <input type="text" name="email" title="Email" placeholder="邮箱" class="userinfo_input" />
          <input type="text" name="password" title="Password" placeholder="密码" class="userinfo_input" />
          <a href="javascript:void(0);" title="登陆" class="loginbtn btn margin_btn_0">登陆</a>         
        </div>
        <div class="lost_pwd">
          <div class="lost_pwd_d">
            <div>
              <span id="rememberme_s"></span><label for="rememberme_s" id="rememberme_l">记住我</label>  
            </div>  
            <a href="javascript:void(0);" title="忘记密码">忘记密码?</a>       
          </div>         
        </div>
        <script type="text/javascript" charset="utf-8">
          var r = [$("#rememberme_s"),$("#rememberme_l")];
        </script>
      </div>
    </section>

    <footer class="footer">
      <p><strong>©2013 V2UP.</strong> All right Resevered. Designed by 设计师
    </footer>
  </div>
  </body>
</html>