<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>goldilocks</title>
    <style>
        * {
            margin:0;
            padding:0;
        }
        html, body {
            height:100%;
            overflow:hidden;
        }   
    </style>
</head>
<body>
<?
    $full = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $tmp = explode('?', $full);
    $full = $tmp[0];
    if(!empty($_GET['bonus'])) $bonus = '|||'.$_GET['bonus'];
    else $bonus = '';
?>
    <object width="100%" height="100%" id="flash" name="goldilocks_flash" data="<?=$full?>GTSWrapper.swf?brand=vanilla&amp;theGame=<?=$full?>goldilocks.swf&amp;lang=<?=$full?>goldilocks_en.xml&amp;edgeServlet=http://localhost/core/WebEngine.php?game=goldilocks|||quickspin<?=$bonus?>&amp;width=640&amp;height=425&amp;vssession=&amp;loginScript=loadLobby()&amp;play4=free&amp;domain=harrycasino.com&amp;nativeHeight=700&amp;nativeWidth=1130&amp;gameTitle=goldilocks" type="application/x-shockwave-flash" style="opacity: 1; width: 100%;"><param name="movie" value="https://casinoeuro.hs.llnwd.net/e2/web-static/gts/wrapper/1.7/GTSWrapper.swf?brand=vanilla&amp;theGame=https://casinoeuro.hs.llnwd.net/e2/web-static/gts/games/sopranos/7-0/goldilocks.swf&amp;lang=https://casinoeuro.hs.llnwd.net/e2/web-static/gts/games/sopranos/7-0/lang/sopranos_en.xml&amp;edgeServlet=http://gts.bgamemodule.com/edge/WebEngine&amp;width=640&amp;height=425&amp;vssession=&amp;loginScript=loadLobby()&amp;play4=free&amp;domain=harrycasino.com&amp;nativeHeight=700&amp;nativeWidth=1130&amp;gameTitle=goldilocks"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="quality" value="high"><param name="base" value="."><param name="wmode" value="direct"><param name="scale" value="exactfit"><param name="flashvars" value="helpURL=javascript:$j(&quot;#goldilocks&quot;).data(&quot;game&quot;).loadGameRules();"></object>
    
    <script>
        setTimeout(function() {
            
            var o = document.getElementById("flash");
            o.setAttribute("height", "99%");
            setTimeout(function() {
                o.setAttribute("height", "100%");
            }, 500);
            
        }, 2000);
    </script>
</body>
</html>
