
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no">
<script type="text/javascript" src="./js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="./js/lazyload.min.js"></script>
<!-- <script type="text/javascript" src="./js/jquery.lazyload.min.js"></script> -->
<style type="text/css">
    html {
        overflow: hidden;
    }
    body {
        margin: 0px;
        padding: 0px;
        background: #000;
        width: 100%;
        height: 100%;
    }
    #imageFlow {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0%;
        background: #000;
    }
    #imageFlow .diapo {
        position: absolute;
        left: -1000px;
        cursor: pointer;
        -ms-interpolation-mode: nearest-neighbor;
    }
    #imageFlow .link {
        border: dotted #fff 1px;
        margin-left: -1px;
        margin-bottom: -1px;
    }
    #imageFlow .bank {
        visibility: hidden;
        /*display: none;*/
    }
    #imageFlow .text {
        position: absolute;
        left: 0px;
        width: 100%;
        bottom: 15%;
        text-align: center;
        color: #FFF;
        font-family: verdana, arial, Helvetica, sans-serif;
        z-index: 1000;
    }
    #imageFlow .title {
        font-size: 0.9em;
        font-weight: bold;
    }
    #imageFlow .legend {
        font-size: 0.8em;
    }
    #imageFlow .scrollbar {
        position: absolute;
        left: 10%;
        bottom: 5%;
        width: 80%;
        height: 16px;
        z-index: 1000;
    }    
    #imageFlow .track {
        position: absolute;
        left: 1%;
        width: 98%;
        height: 16px;
        filter: alpha(opacity=30);
        opacity: 0.3;
    }
    #imageFlow .arrow-left {
        position: absolute;
        top: -9px;
    }
    #imageFlow .arrow-right {
        position: absolute;
        right: 0px;
        top: -9px;
    }
    #imageFlow .bar {
        position: absolute;
        left: 25px;
        top: -50px;
    }
    #imageFlow .scrollbar1 {
        position: absolute;
        left: 25%;
        bottom: 12%;
        width: 50%;
        height: 16px;
        z-index: 1000;
    }
    #imageFlow .track1 {
        position: absolute;
        left: 1%;
        width: 98%;
        height: 16px;
        filter: alpha(opacity=30);
        opacity: 0.3;
    }
    #imageFlow .arrow-left1 {
        position: absolute;
        top: -8px;
    }
    #imageFlow .arrow-right1 {
        position: absolute;
        right: 0px;
        top: -8px;
    }
    #imageFlow .bar1 {
        position: absolute;
        left: 25px;
        height: 100%;
        /*top: -50px;*/
    }
    #form1 {
        font-size: 20px;
    }
    #attr {
        padding-top: 3px;
        font-size: 25px;
        color: #DDFF77;
    }
    #example {
        position: absolute;
        top: 10px;
        right: 50px;
        width: 250px;
    }
    #example img {
        width: 100%;
    }
    #example #txt {
        text-align: center;
        font-size: 25px;
        color: #FFF;
    }
    #example_left {
        position: absolute;
        top: 10px;
        left: 50px;
        width: 250px;
    }
    #example_left img {
        width: 100%;
    }
    #example_left #txt {
        text-align: center;
        font-size: 25px;
        color: #FFF;
    }
    #prepage {
        text-align: center;
        font-size: 15px;
        color: red;
        position: absolute;
        top: 50px;
        left: 50px;
    }
    #prepage a {
        color: red;
    }
    #nextpage {
        text-align: center;
        font-size: 15px;
        color: green;
        position: absolute;
        top: 50px;
        left: 120px;
    }
    #nextpage a {
        color: green;
    }
    .pages {
        visibility: visible;
        position: absolute;
        top: 40%;
        left: 50%;
        z-index: 99;
    }
    .page {
        visibility: visible;
        color: green;
        font-size: 25px;
    }
    #explanation {
        position: absolute;
        width: 600px;
        /*height: 500px;*/
        top: 10px;
        left: 35%;
        /*margin: auto;*/
    }
    .header {
        /*position: absolute;
        left: 50%;
        transform: translateX(-50%);*/
        font-size: 15px;
        color: red;
    }
    .mainbody {
        /*position: absolute;
        left: 50%;
        transform: translateX(-50%);*/
        font-size: 15px;
        color: #FFF;
    }
</style>
<script type="text/javascript">
var num = 0; // 第几个属性
var imf = function () {
    var lf = 0;
    var instances = [];
    //定义一个通过class获得元素的方法
    function getElementsByClass (object, tag, className) {
        var o = object.getElementsByTagName(tag);
        for ( var i = 0, n = o.length, ret = []; i < n; i++)
            if (o[i].className == className) ret.push(o[i]);
        if (ret.length == 1) ret = ret[0];
        return ret;
    }
    function addEvent (o, e, f) {
        if (window.addEventListener) o.addEventListener(e, f, false);
        else if (window.attachEvent) r = o.attachEvent('on' + e, f);
    }
    function createReflexion (cont, img) {
        var flx = false;
        if (document.createElement("canvas").getContext) {
            flx = document.createElement("canvas");
            flx.width = img.width;
            flx.height = img.height;
            var context = flx.getContext("2d");
            context.translate(0, img.height);
            context.scale(1, -1);
            context.drawImage(img, 0, 0, img.width, img.height);
            context.globalCompositeOperation = "destination-out";
            var gradient = context.createLinearGradient(0, 0, 0, img.height * 2);
            gradient.addColorStop(1, "rgba(255, 255, 255, 0)");
            gradient.addColorStop(0, "rgba(255, 255, 255, 1)");
            context.fillStyle = gradient;
            context.fillRect(0, 0, img.width, img.height * 2);
        } else {
            /* ---- DXImageTransform ---- */
            flx     = document.createElement('img');
            flx.src = img.src;
            flx.style.filter = 'flipv progid:DXImageTransform.Microsoft.Alpha(' +
                               'opacity=50, style=1, finishOpacity=0, startx=0, starty=0, finishx=0, finishy=' +
                               (img.height * .25) + ')';
        }
        /* ---- insert Reflexion ---- */
        flx.style.position = 'absolute';
        flx.style.left     = '-1000px';
        cont.appendChild(flx);
        return flx;
    }
    /* //////////// ==== ImageFlow Constructor ==== //////////// */
    function ImageFlow(oCont, size, zoom, border) {
        this.diapos     = [];
        this.scr        = false;
        this.size       = size;
        this.zoom       = zoom;
        this.bdw        = border;
        this.oCont      = oCont;
        this.oc         = document.getElementById(oCont);
        this.scrollbar  = getElementsByClass(this.oc,   'div', 'scrollbar');
        this.text       = getElementsByClass(this.oc,   'div', 'text');
        this.title      = getElementsByClass(this.text, 'div', 'title');
        this.legend     = getElementsByClass(this.text, 'div', 'legend');
        this.bar        = getElementsByClass(this.oc,   'img', 'bar');
        this.arL        = getElementsByClass(this.oc,   'img', 'arrow-left');
        this.arL1       = getElementsByClass(this.oc,   'img', 'arrow-left1');
        this.arR        = getElementsByClass(this.oc,   'img', 'arrow-right');
        this.arR1       = getElementsByClass(this.oc,   'img', 'arrow-right1');
        this.bw         = this.bar.width;
        this.alw        = this.arL.width - 5;
        this.arw        = this.arR.width - 5;
        this.bar.parent = this.oc.parent  = this;
        this.arL.parent = this.arR.parent = this;
        this.arL1.parent= this.arR1.parent = this;
        this.view       = this.back       = -1;
        this.resize();
        this.oc.onselectstart = function () { return false; }
        /* ---- create images ---- */
        // var img   = getElementsByClass(this.oc, 'div', 'bank').getElementsByTagName('a');
        var img   = getElementsByClass(this.oc, 'a', 'pic');
        this.NF = img.length;
        for (var i = 0, o; o = img[i]; i++) {
            this.diapos[i] = new Diapo(this, i,
                                        o.rel,
                                        o.title || '- ' + i + ' -',
                                        o.innerHTML || o.rel,
                                        o.href || '',
                                        o.target || '_self'
            );
        }
        /* ==== add mouse wheel events ==== */
        if (window.addEventListener)
            this.oc.addEventListener('DOMMouseScroll', function(e) {
                this.parent.scroll(-e.detail);
            }, false);
        else this.oc.onmousewheel = function () {
            this.parent.scroll(event.wheelDelta);
        }
        /* ==== scrollbar drag N drop ==== */
        this.bar.onmousedown = function (e) {
            if (!e) e = window.event;
            var scl = e.screenX - this.offsetLeft;
            var self = this.parent;
            var old_left = self.bar.style.left;
            var old_view = self.view;
            var old_num = num;
            var old_attr = $("#attr").html();
            /* ---- move bar ---- */
            this.parent.oc.onmousemove = function (e) {
                if (!e) e = window.event;
                self.bar.style.left = Math.round(Math.min((self.ws - self.arw - self.bw), Math.max(self.alw, e.screenX - scl))) + 'px';
                self.view = Math.round(((e.screenX - scl) ) / (self.ws - self.alw - self.arw - self.bw) * self.NF);
                if (self.view != self.back) self.calc();
                return false;
            }
            /* ---- release scrollbar ---- */
            this.parent.oc.onmouseup = function (e) {
                if (old_num != 0 && old_num != 16) {
                    alert("请将此人的属性标注完整，最后一个属性是“年轻”！");
                    self.bar.style.left = old_left;
                    self.view = old_view;
                    if (self.view != self.back) self.calc();
                    // num = old_num;
                    // $("#attr").html(old_attr);
                }
                self.oc.onmousemove = null;
                return false;
            }
            return false;
        }
        /* ==== right arrow ==== */
        this.arR.onclick = this.arR.ondblclick = function () {
            if (num == 0 || num == 16) {
                if (this.parent.view < this.parent.NF - 1)
                    this.parent.calc(1);
            }
            else {
                alert("请将此人的属性标注完整，最后一个属性是“年轻”！");
            }
        }
        /* ==== Left arrow ==== */
        this.arL.onclick = this.arL.ondblclick = function () {
            if (num == 0 || num == 16) {
                if (this.parent.view > 0)
                    this.parent.calc(-1);    
            }
            else {
                alert("请将此人的属性标注完整，最后一个属性是“年轻”！");
            }
        }

        // this.arL1.onclick = this.arL1.ondblclick = function () {
        //     if (this.parent.view > 0)
        //         this.parent.calc(-1);
        // }
        // this.arR1.onclick = this.arR1.ondblclick = function () {
        //     if (this.parent.view < this.parent.NF - 1)
        //         this.parent.calc(1);
        // }
    }
    /* //////////// ==== ImageFlow prototype ==== //////////// */
    ImageFlow.prototype = {
        /* ==== targets ==== */
        calc : function (inc) {
            if (inc) this.view += inc;
            var tw = 0;
            var lw = 0;
            var o = this.diapos[this.view];
            if (o && o.loaded) {
                /* ---- reset ---- */
                var ob = this.diapos[this.back];
                if (ob && ob != o) {
                    ob.img.className = 'diapo';
                    ob.z1 = 1;
                }
                /* ---- update legend ---- */
                this.title.replaceChild(document.createTextNode(o.title), this.title.firstChild);
                this.legend.replaceChild(document.createTextNode(o.text), this.legend.firstChild);
                /* ---- update hyperlink ---- */
                if (o.url) {
                    o.img.className = 'diapo lazyload link';
                    window.status = 'hyperlink: ' + o.url;
                } else {
                    o.img.className = 'diapo lazyload';
                    window.status = '';
                }
                /* ---- calculate target sizes & positions ---- */
                o.w1 = Math.min(o.iw, this.wh * .5) * o.z1;
                var x0 = o.x1 = (this.wh * .5) - (o.w1 * .5);
                var x = x0 + o.w1 + this.bdw;
                for (var i = this.view + 1, o; o = this.diapos[i]; i++) {
                    if (o.loaded) {
                        o.x1 = x;
                        o.w1 = (this.ht / o.r) * this.size;
                        x   += o.w1 + this.bdw;
                        tw  += o.w1 + this.bdw;
                    }
                }
                x = x0 - this.bdw;
                for (var i = this.view - 1, o; o = this.diapos[i]; i--) {
                    if (o.loaded) {
                        o.w1 = (this.ht / o.r) * this.size;
                        o.x1 = x - o.w1;
                        x   -= o.w1 + this.bdw;
                        tw  += o.w1 + this.bdw;
                        lw  += o.w1 + this.bdw;
                    }
                }
                /* ---- move scrollbar ---- */
                if (!this.scr && tw) {
                    var r = (this.ws - this.alw - this.arw - this.bw) / tw;
                    this.bar.style.left = Math.round(this.alw + lw * r) + 'px';
                }
                /* ---- save preview view ---- */
                this.back = this.view;
            }
        },
        /* ==== mousewheel scrolling ==== */
        scroll : function (sc) {
            if (sc < 0) {
                if (this.view < this.NF - 1) this.calc(1);
            } else {
                if (this.view > 0) this.calc(-1);
            }
        },
        /* ==== resize  ==== */
        resize : function () {
            this.wh = this.oc.clientWidth;
            this.ht = this.oc.clientHeight;
            this.ws = this.scrollbar.offsetWidth;
            this.calc();
            this.run(true);
        },
        /* ==== move all images  ==== */
        run : function (res) {
            var i = this.NF;
            while (i--) this.diapos[i].move(res);
        }
    }
    /* //////////// ==== Diapo Constructor ==== //////////// */
    Diapo = function (parent, N, src, title, text, url, target) {
        this.parent        = parent;
        this.loaded        = false;
        this.title         = title;
        this.text          = text;
        this.url           = url;
        this.target        = target;
        this.N             = N;
        this.img           = document.createElement('img');
        this.img.src       = '';
        // this.img.src       = src;
        this.img.parent    = this;
        this.img.className = 'diapo lazyload';
        this.x0            = this.parent.oc.clientWidth;
        this.x1            = this.x0;
        this.w0            = 0;
        this.w1            = 0;
        this.z1            = 1;
        this.img.parent    = this;
        this.img.onclick   = function() { this.parent.click(); }
        this.parent.oc.appendChild(this.img);
        // this.img.setAttribute("data-original", src);
        this.img.setAttribute("data-src", src);
        this.img.width = "120";
        this.img.height = "200";
        /* ---- display external link ---- */
        if (url) {
            this.img.onmouseover = function () { this.className = 'diapo link lazyload'; }
            this.img.onmouseout  = function () { this.className = 'diapo lazyload'; }
        }
    }
    /* //////////// ==== Diapo prototype ==== //////////// */
    Diapo.prototype = {
        /* ==== HTML rendering ==== */
        move : function (res) {
            if (this.loaded) {
                var sx = this.x1 - this.x0;
                var sw = this.w1 - this.w0;
                if (Math.abs(sx) > 2 || Math.abs(sw) > 2 || res) {
                    /* ---- paint only when moving ---- */
                    this.x0 += sx * .1;
                    this.w0 += sw * .1;
                    if (this.x0 < this.parent.wh && this.x0 + this.w0 > 0) {
                        /* ---- paint only visible images ---- */
                        this.visible = true;
                        var o = this.img.style;
                        var h = this.w0 * this.r;
                        /* ---- diapo ---- */
                        o.left   = Math.round(this.x0) + 'px';
                        o.bottom = Math.floor(this.parent.ht * .25) + 'px';
                        o.width  = Math.round(this.w0) + 'px';
                        o.height = Math.round(h) + 'px';
                        /* ---- reflexion ---- */
                        if (this.flx) {
                            var o = this.flx.style;
                            o.left   = Math.round(this.x0) + 'px';
                            o.top    = Math.ceil(this.parent.ht * .75 + 1) + 'px';
                            o.width  = Math.round(this.w0) + 'px';
                            o.height = Math.round(h) + 'px';
                        }
                    } else {
                        /* ---- disable invisible images ---- */
                        if (this.visible) {
                            this.visible = false;
                            this.img.style.width = '0px';
                            if (this.flx) this.flx.style.width = '0px';
                        }
                    }
                }
            } else {
                /* ==== image onload ==== */
                if (this.img.complete && this.img.width) {
                    /* ---- get size image ---- */
                    this.iw     = this.img.width;
                    this.ih     = this.img.height;
                    this.r      = this.ih / this.iw;
                    this.loaded = true;
                    /* ---- create reflexion ---- */
                    this.flx    = createReflexion(this.parent.oc, this.img);
                    if (this.parent.view < 0) this.parent.view = this.N;
                    this.parent.calc();
                }
            }
        },
        /* ==== diapo onclick ==== */
        click : function () {
            if (this.parent.view == this.N) {
                /* ---- click on zoomed diapo ---- */
                if (this.url) {
                    /* ---- open hyperlink ---- */
                    window.open(this.url, this.target);
                } else {
                    /* ---- zoom in/out ---- */
                    this.z1 = this.z1 == 1 ? this.parent.zoom : 1;
                    this.parent.calc();
                }
            } else {
                /* ---- select diapo ---- */
                this.parent.view = this.N;
                this.parent.calc();
            }
            return false;
        }
    }
    /* //////////// ==== public methods ==== //////////// */
    return {
        /* ==== initialize script ==== */
        create : function (div, size, zoom, border) {
            /* ---- instanciate imageFlow ---- */
            var load = function () {
                var loaded = false;
                var i = instances.length;
                while (i--) if (instances[i].oCont == div) loaded = true;
                if (!loaded) {
                    /* ---- push new imageFlow instance ---- */
                    instances.push(
                        new ImageFlow(div, size, zoom, border)
                    );
                    $("img.lazyload").lazyload();
                    /* ---- init script (once) ---- */
                    if (!imf.initialized) {
                        imf.initialized = true;
                        /* ---- window resize event ---- */
                        addEvent(window, 'resize', function () {
                            var i = instances.length;
                            while (i--) instances[i].resize();
                        });
                        /* ---- stop drag N drop ---- */
                        addEvent(document.getElementById(div), 'mouseout', function (e) {
                            if (!e) e = window.event;
                            var tg = e.relatedTarget || e.toElement;
                            if (tg && tg.tagName == 'HTML') {
                                var i = instances.length;
                                while (i--) instances[i].oc.onmousemove = null;
                            }
                            return false;
                        });
                        /* ---- set interval loop ---- */
                        setInterval(function () {
                            var i = instances.length;
                            while (i--) instances[i].run();
                        }, 16);
                    }
                }
            }
            /* ---- window onload event ---- */
            addEvent(window, 'load', function () { load(); });
        }
    }
}();

/* ==== create imageFlow ==== */
//          div ID    , size, zoom, border
imf.create("imageFlow", 0.15, 1.5, 10);

</script>
</head>
<body>  
<script type="text/javascript">
var num = 0;    //第几个属性
$(document).ready(function() {
    var folder = "C0084";
    var local_url = document.location.href;
    var params = local_url.split("?")[1].split("&");
    for (var i = 0; i < params.length; i++) {
        var param = params[i];
        var idx = param.split("=")[0];
        var val = param.split("=")[1];
        if (idx == "folder") folder = val;
    }
    $("img.lazyload").lazyload();
    $(".selected").click(function() {        
        var val = $(this).val();
        // if (isset($_GET["folder"]) $_GET["folder"] = "C0084";
        $.post('server.php', {val: val, num: num, filename: $(".legend").html(), partid: folder}, function(msg) {
            if (msg.status == 1)
            {
                if (num < 0) {
                    $("#example #attr").html(msg.attr);
                    $("#example #txt").html(msg.attr + "样例");
                    $("#example img").attr("src", "./pic/example/" + msg.attr + ".jpg");

                    $("#example_left #attr").html(msg.attr);
                    $("#example_left #txt").html(msg.attr + "样例");
                    $("#example_left img").attr("src", "./pic/example/" + msg.attr + ".jpg");
                    num++; 
                }   
                else {
                    $(".arrow-right").click();
                    // $(".selected").attr('checked', false);
                }
            }
        }, "json");
    });

    // $("#nextpage").click(function() {
    //     window.location.reload()
    // });

    $(".title").bind("DOMNodeInserted", function() {
        $("#example #attr").html("**");
        // $("#attr").html("拱眉");
        $("#example #txt").html("**样例");
        $("#example img").attr("src", "./pic/example/大嘴唇.jpg");

        $("#example_left #attr").html("非**");
        // $("#attr").html("拱眉");
        $("#example_left #txt").html("非**样例");
        $("#example_left img").attr("src", "./pic/example/浓眉.jpg");
        num = 0;
    });

});
function test() {
    if (event.keyCode == 37) {
        $("#select1").click();
    }
    else if (event.keyCode == 39) {
        $("#select2").click();
    }
    else if (event.keyCode == 38) {
        $("#select3").click();
    }
}
document.onkeydown = function() {test();}
</script>          
<div id="imageFlow">
    <div class="bank">
        <?php 
        function readPic($dir)
        {
            $files = array();
            if (is_dir($dir))
            {
                if ($handle = opendir($dir))
                {
                    while (($file = readdir($handle)) !== false) {
                        if ($file != '.' && $file != '..')
                        {
                            if (is_dir($dir."/".$file))
                            {
                                $files[$file] = readPic($dir."/".$file);
                            }
                            else
                            {
                                $files[] = $dir."/".$file;
                            }
                        }
                    }
                    closedir($handle);
                }
            }
            return $files;
        }   
        // $data = readPic("./pic/gallery");
        if (!isset($_GET["folder"])) $_GET["folder"] = "C0084";
        $data = readPic("./pic/figure/".$_GET["folder"]);
        $pagenum = intval(count($data) / 1000);
        $lastnum = count($data) % 1000;
        if ($pagenum == 0) {
            for ($i = 0; $i < count($data); $i++)
            // for ($i = 0; $i < 1000; $i++)
            {            
        ?>
        <a rel="<?php echo($data[$i]); ?>" title="" href="#" class="pic">
        <?php
            $filename_arr = explode("/", $data[$i]);
            $filename = explode(".", $filename_arr[count($filename_arr)-1])[0];
            echo trim($filename);
        ?>
        </a>
        <?php 
            } 
        } 
        else {
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $url = explode("?", $url)[0]
        ?>
        <div class="pages">
        <?php
            for ($i = 1; $i <= $pagenum + 1; $i++) {
        ?>
        <a class="page" href="<?php echo $url.'?folder='.$_GET['folder'].'&page='.strval($i-1); ?>"><?php echo $i ?></a>
        <?php
            }
        ?>
        </div>
        <?php
            if (!isset($_GET["page"])) $_GET["page"] = 0;
            if ($_GET["page"] > $pagenum) $_GET["page"] = 0;
            $start = $_GET["page"] * 1000;
            $end = 1000;
            if ($_GET["page"] == $pagenum)  $end = count($data);
            else $end = ($_GET["page"] + 1) * 1000;
            for ($i = $start; $i < $end; $i++) {
        ?>
        <a rel="<?php echo($data[$i]); ?>" title="" href="#" class="pic">
        <?php
            $filename_arr = explode("/", $data[$i]);
            $filename = explode(".", $filename_arr[count($filename_arr)-1])[0];
            echo trim($filename);
        ?>
        </a>
        <?php
            }
        }
        ?>
    </div>
    <div class="text">
        <div class="title">
            Loading</div>
        <div class="legend">
            Please wait...</div>  
        <div id="attr">
        折指
        </div>        
        <div id="form1">
            <input type="radio" name="attribute" value="1" class="selected" id="select1" />是&nbsp;&nbsp;&nbsp;
            <input type="radio" name="attribute" value="0" class="selected" id="select2" />否&nbsp;&nbsp;&nbsp;
            <input type="radio" name="attribute" value="-1" class="selected" id="select3" />删
        </div> 
    </div>
    <div class="scrollbar1" style="display: none">
        <img class="track1" src="pic/common/track.jpg" alt="">
        <img class="arrow-left1" src="pic/common/sign_out.png" alt="">
        <img class="arrow-right1" src="pic/common/sign_in.png" alt="">
        <img class="bar1" src="pic/common/bar.jpg" alt=""> 
    </div>
    <div class="scrollbar">
        <img class="track" src="pic/common/track.jpg" alt="">
        <img class="arrow-left" src="pic/common/left-arrow.png" alt="">
        <img class="arrow-right" src="pic/common/right-arrow.png" alt="">
        <img class="bar" src="pic/common/bar.gif" alt=""> 
    </div>
    <div id="example">
        <div><img src="./pic/example/大嘴唇.jpg"></div>
        <div id="txt">**样例</div>
    </div>
    <div id="example_left">
        <div><img src="./pic/example/浓眉.jpg"></div>
        <div id="txt">非**样例</div>
    </div>
    <div id="explanation">
        <div class="header">**说明：</div>
        <div class="mainbody">
        </div>
        <div class="header">标注说明：</div>
        <div class="mainbody">
            1. 快捷键：左方向键（←）是，右方向键（→）否，上方向键（↑）删。
        </div>
    </div>
</div>
<!-- <div id="prepage" class="changepage"><a href="">上一页</a></div>
<div id="nextpage" class="changepage"><a href="">下一页</a></div> -->
</body>
</html>