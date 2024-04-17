<style>
    *{
        font-family: 'Times New Roman', Times, serif;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="header">
    <?php
    if(isset($_COOKIE['jwt'])) {
        include("header1.php");
    }
    else {
        include("header.php");
    }
    ?>
</div>
<div class="content_main" id="content_main">
    <?php
    include("slider-container.php");
    include("screen_cwrap.php");
    ?>
</div>
<div class="footer">
    <?php
    include("footer.php");
    ?>
</div>
<script src="/js/app.js"></script>