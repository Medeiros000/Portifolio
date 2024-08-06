<h1><?php echo $l_projec['title'][$lang] ?></h1>
<div class="container">
    <hr>
    <div class="project">
        <span class="link"><?php echo $l_projec['blog'][$lang] ?></span>
        <input type="hidden" id="link" value="blog">
        <p><?php echo $l_projec['blog-desc'][$lang] ?></p>
        <img src="img/blog.png" alt="">
    </div>
    <hr>
    <div class="project">
        <span class="link"><?php echo $l_projec['crud'][$lang] ?></span>
        <input type="hidden" id="link" value="crud">
        <p><?php echo $l_projec['crud-desc'][$lang] ?></p>
        <img src="img/crud.png" alt="">
    </div>
    <hr>
    <div class="project">
        <span class="link"><?php echo $l_projec['jwt'][$lang] ?></span>
        <input type="hidden" id="link" value="jwt">
        <p><?php echo $l_projec['jwt-desc'][$lang] ?></p>
        <img src="img/jwt.png" alt="">
    </div>
</div>

<script>
    $().ready(() => {
        $('.project').each(function() {
            $('.project').on('mouseenter', function() {
                $('.project').addClass('grayscale');
                $(this).removeClass('grayscale');
            });
        });
        $('.project').each(function() {
            $(this).on('mouseleave', function() {
                $('.project').each(function() {
                    $(this).removeClass('grayscale');
                });
            });
        });
    });
    $('.project').each(function() {
        $(this).on('click', function() {
            let a = $(this).find('#link').val().toLowerCase();
            window.location.href = `/${a}`;
        });

    });
</script>