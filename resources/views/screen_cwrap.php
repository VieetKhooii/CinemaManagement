<link rel="stylesheet" href="../css/screen_cwrap.css">

<script src="/js/foot_item.js"></script>
<script>
    $(document).ready(function() {
        getMovies();
    });
</script>
<div id="list_item_container">

</div>
<script>
    const header = document.querySelector('.screenwrap')
    const headerRect = header.getBoundingClientRect();
    const distanceToTop = headerRect.top;
    const plottingQC = document.getElementById('plottingQC')
    const screenwrapFilm = document.getElementById('screenwrap');
    // alert(distanceToTop)
    window.addEventListener('scroll', function() {
        x = window.scrollY +150;
        // console.log("x: "+x)
        // console.log("distanceToTop: "+distanceToTop)
        var plottingQCTop = parseInt(plottingQC.style.top.replace('px', ''));
        const screenwrapFilmHeight = screenwrapFilm.offsetHeight;
        const screenwrapFilmTop = screenwrapFilm.offsetTop;
        if (x > distanceToTop) {
            plottingQC.style.transition = 'top 0.3s linear'
            //gán lại chiều cao của plottingQC  
            plottingQC.style.top = `${(x - distanceToTop)}px`;
        } else {
            plottingQC.style.top = '0px';
        }
        if (x + plottingQC.offsetHeight >= screenwrapFilmHeight + screenwrapFilmTop -20) {
            plottingQC.style.top = `${(screenwrapFilmHeight - plottingQC.offsetHeight)}px`;
        }
    });
</script>