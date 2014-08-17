<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scal=1" />
   
	<title>猿楽祭｜HILISIDE TERRACE 代官山フェステリバル</title>
    <meta name="keywords" content="代官山,猿楽祭,ヒルサイドテラス" />
    <meta name="description" content="猿楽祭のオフィシャルサイトです" />
	
    <meta property="og:title" content="猿楽祭｜HILISIDE TERRACE 代官山フェステリバル"></meta> 
	<meta property="og:type" content="article"></meta> 
	<meta property="og:description" content="猿楽祭のオフィシャルサイトです"></meta> 
	<meta property="og:url" content="http://sarugakumatsuri.com/"></meta> 
	
	<!--bootstrap-->
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/css/jquery.fullPage.css" rel="stylesheet" type="text/css" />
    <!--common-->
    <link href="/css/common2.css" rel="stylesheet" type="text/css" media="all" />
    
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <noscript>
        <div class="alert alert-warning">
           現在、ブラウザの設定でJavaScriptが使用できない状態になっており、一部の機能が正しく表示されておりません。
        </div>
    </noscript>
    
    <div id="fullpage">
        <div class="section" data-anchor="top">
             <div class="slide">
                 <img src="http://www.kumamoto-kibun.jp/assets/images/top/main_photo1.jpg" class="img-bg"/>
                 <div class="about">
                     hello
                 </div>
             </div>
             <div class="slide">
                <img src="http://www.kumamoto-kibun.jp/assets/images/top/main_photo2.jpg" class="img-bg"/>
             </div>
             <div class="slide">
                <img src="http://www.kumamoto-kibun.jp/assets/images/top/main_photo3.jpg" class="img-bg"/>
             </div>
            
        </div>
        <div class="section" data-anchor="cat1">WHATEVER</div>
        <div class="section" data-anchor="cat2">WHATEVER</div>
        <div class="section" data-anchor="cat3">WHATEVER</div>
        <div class="section" data-anchor="cat4">WHATEVER</div>
        <div class="section" data-anchor="cat5">WHATEVER</div>
    </div>
    
    <nav id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div id="cat-link" class="container">
            <ul class="nav navbar-nav" id="menu">
                <li data-menuanchor="top"><a class="anm_button" href="#top">猿楽祭</a></li>
                <li data-menuanchor="cat1"><a class="anm_button" href="#cat1">カテゴリ名</a></li>
                <li data-menuanchor="cat2"><a href="#cat2" class="anm_button">カテゴリ名</a></li>
                <li data-menuanchor="cat3"><a href="#cat3" class="anm_button">カテゴリ名</a></li>
                <li data-menuanchor="cat4"><a href="#cat4" class="anm_button">カテゴリ名</a></li>
                <li data-menuanchor="cat5"><a href="#cat5" class="anm_button">カテゴリ名</a></li>
            </ul>
        </div>
        <div id="bottom-link">
            Copyright xxxx
        </div>
    </nav>
    
    <script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/jquery.easings.min.js"></script>
    <script type="text/javascript" src="/js/jquery.fullPage.js"></script>
    <script type="text/javascript" src="/js/jquery.slimscroll.min.js"></script>
    
    
    <script type="text/javascript">
        $(window).load(function() {    

            var theWindow        = $(window),
                $bg              = $("img.img-bg"),
                aspectRatio      = $bg.width() / $bg.height();

            function resizeBg() {

                if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
                    $bg.css({height:'100%',width:'auto'});
                } else {
                    $bg.css({height:'auto',width:'100%'});
                }

            }

            theWindow.resize(resizeBg).trigger("resize");

        });
    $(document).ready(function() {
        
        $('#fullpage').fullpage({
            css3:true,
            menu:"#menu",
            anchors: ['top', 'cat1', 'cat2', 'cat3', 'cat4','cat5'],
        });
        $("#cat-link>ul>li>a").click(function(){
            $("#cat-link>ul>li").removeClass("active");
            $(this).parents("li").addClass("active");
        });
    });    
    </script>
</body>
</html>
