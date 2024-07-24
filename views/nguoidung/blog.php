<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from caketheme.com/html/ruper/blog-grid-left.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jul 2024 00:54:15 GMT -->

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Grid - Left Sidebar | Ruper</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="media/favicon.png">

    <!-- Dependency Styles -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/feather-font/css/iconfont.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/icomoon-font/css/icomoon.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/font-awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/wpbingofont/css/wpbingofont.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/elegant-icons/css/elegant.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/slick/css/slick.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/slick/css/slick-theme.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/mmenu/css/mmenu.min.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/libs/slider/css/jslider.css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/assets/css/app.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/ruper/assets/css/responsive.css" type="text/css">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@100;200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;display=swap" rel="stylesheet">
</head>

<body class="blog">
    <div id="page" class="hfeed page-wrapper">

        <?php
        if (isset($_SESSION['admin'])) {
            $admin = $_SESSION['admin'];
            require_once './views/layouts/partials/headerdangnhap.php';
        }else{
            require_once './views/layouts/partials/header.php';
        
        }
        ?>
       

        <div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    <div id="title" class="page-title">
                        <div class="section-container">
                            <div class="content-title-heading">
                                <h1 class="text-title-heading">
                                    Blog Woody
                                </h1>
                            </div>
                            <div class="breadcrumbs">
                                <a href="">Trang chủ</a><span class="delimiter"></span> Blog Woody
                            </div>
                        </div>
                    </div>

                    <div id="content" class="site-content" role="main">
                        <div class="section-padding">
                            <div class="section-container p-l-r">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-12 col-12 sidebar left-sidebar md-b-50">
                                        <!-- Block Post Search -->
                                        

                                        <!-- Block Post Categories -->
                                        <div class="block block-post-cats">
                                            <div class="block-title">
                                                <h2>Danh mục</h2>
                                            </div>
                                            <div class="block-content">
                                                <div class="post-cats-list">
                                                    <ul>
                                                        <li class="current">
                                                            <a href="blog-grid-left.html">Nội thất phòng ngủ <span class="count">9</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Nội thất phòng khách <span class="count">4</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Nội thất phòng bếp <span class="count">3</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Nội thất văn phòng <span class="count">6</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Sản phẩm trang trí<span class="count">2</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Block Posts -->
                                        <div class="block block-posts">
                                            <div class="block-title">
                                                <h2>Recent Posts</h2>
                                            </div>
                                            <div class="block-content">
                                                <ul class="posts-list">
                                                    <li class="post-item">
                                                        <a href="blog-details-right.html" class="post-image">
                                                            <img src="<?= BASE_URL ?>assets/ruper/media/blog/1.jpg">
                                                        </a>
                                                        <div class="post-content">
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">
                                                                    Easy Fixes for Home Decor
                                                                </a>
                                                            </h2>
                                                            <div class="post-time">
                                                                <span class="post-date">May 30, 2022</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="post-item">
                                                        <a href="blog-details-right.html" class="post-image">
                                                            <img src="<?= BASE_URL ?>assets/ruper/media/blog/2.jpg">
                                                        </a>
                                                        <div class="post-content">
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">
                                                                    How to Make your Home a Showplace
                                                                </a>
                                                            </h2>
                                                            <div class="post-time">
                                                                <span class="post-date">Aug 24, 2022</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="post-item">
                                                        <a href="blog-details-right.html" class="post-image">
                                                            <img src="<?= BASE_URL ?>assets/ruper/media/blog/3.jpg">
                                                        </a>
                                                        <div class="post-content">
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">
                                                                    Stunning Furniture with Aesthetic Appeal
                                                                </a>
                                                            </h2>
                                                            <div class="post-time">
                                                                <span class="post-date">Dec 06, 2022</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Block Post Archives -->
                                        <div class="block block-post-archives">
                                            <div class="block-title">
                                                <h2>Archives</h2>
                                            </div>
                                            <div class="block-content">
                                                <div class="post-archives-list">
                                                    <ul>
                                                        <li>
                                                            <a href="blog-grid-left.html">May 2021</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">April 2021</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">August 2020</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Block Post Tags -->
                                        <div class="block block-post-tags">
                                            <div class="block-title">
                                                <h2>Tags</h2>
                                            </div>
                                            <div class="block-content">
                                                <div class="post-tags-list">
                                                    <ul>
                                                        <li>
                                                            <a href="blog-grid-left.html">Baber</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Baby Needs</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Beauty</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Cosmetic</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Electric</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Fashion</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Mimimal</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Simple</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog-grid-left.html">Sport</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                                        <div class="posts-list grid">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Furniture</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">July 24, 2021</span>
                                                                <span class="post-comment">1 Comment</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/2.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Home Decor</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">How to Make your Home a Showplace</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">August 16, 2021</span>
                                                                <span class="post-comment">4 Comments</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/3.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Life Style</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">Stunning Furniture with Aesthetic Appeal</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">October 04, 2021</span>
                                                                <span class="post-comment">3 Comments</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Dining & Kitchen</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">How To Choose The Right Sectional Sofa</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">October 20, 2021</span>
                                                                <span class="post-comment">1 Comment</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/5.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Office</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">How to Make your Home a Showplace</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">December 11, 2021</span>
                                                                <span class="post-comment">5 Comments</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/6.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Life Style</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">February 07, 2022</span>
                                                                <span class="post-comment">2 Comments</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/7.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Dining & Kitchen</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">July 24, 2021</span>
                                                                <span class="post-comment">3 Comments</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/3.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Furniture</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">July 24, 2021</span>
                                                                <span class="post-comment">1 Comment</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="post-entry clearfix post-wapper">
                                                        <div class="post-image">
                                                            <a href="blog-details-right.html">
                                                                <img src="<?= BASE_URL ?>assets/ruper/media/blog/4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <div class="post-categories">
                                                                <a href="blog-grid-right.html">Life Style</a>
                                                            </div>
                                                            <h2 class="post-title">
                                                                <a href="blog-details-right.html">How To Choose The Right Sectional Sofa</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-time">July 24, 2021</span>
                                                                <span class="post-comment">5 Comments</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <nav class="pagination">
                                            <ul class="page-numbers">
                                                <li><a class="prev page-numbers" href="#">Previous</a></li>
                                                <li><span aria-current="page" class="page-numbers current">1</span></li>
                                                <li><a class="page-numbers" href="#">2</a></li>
                                                <li><a class="page-numbers" href="#">3</a></li>
                                                <li><a class="next page-numbers" href="#">Next</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div><!-- #main-content -->
        </div>

        <?php require_once './views/layouts/partials/footer.php';?>
    </div>

    <!-- Back Top button -->
    <?php require_once './views/layouts/partials/modal.php';?>

    <!-- Dependency Scripts -->
    <script src="<?= BASE_URL ?>assets/ruper/libs/popper/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/jquery/js/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/slick/js/slick.min.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/countdown/js/jquery.countdown.min.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/mmenu/js/jquery.mmenu.all.min.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/slider/js/tmpl.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/slider/js/jquery.dependClass-0.1.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/slider/js/draggable-0.1.js"></script>
    <script src="<?= BASE_URL ?>assets/ruper/libs/slider/js/jquery.slider.js"></script>

    <!-- Site Scripts -->
    <script src="<?= BASE_URL ?>assets/ruper/assets/js/app.js"></script>
    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>

<!-- Mirrored from caketheme.com/html/ruper/blog-grid-left.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jul 2024 00:54:16 GMT -->

</html>