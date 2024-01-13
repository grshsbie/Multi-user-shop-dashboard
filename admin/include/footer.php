
<script>
    $('#menu .item-menu').click(function(){

        b = true;
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            b = false;
        }
        if($('.sub-menu',this) && b){
            $('#menu .item-menu').removeClass('active');
            $(this).addClass('active');
        }

    });
</script>

</div>
</body>
</html>