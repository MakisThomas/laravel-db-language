<script>
    $('.btn_lang ul li a').on('click',function(e){
        e.preventDefault();
        self = $(this);
        $(this).closest('.form-group').find('input, textarea').each(function(value){
            ($(this).attr('name').slice(-2) == self.data('code'))
                ? $(this).removeClass('hidden')
                : $(this).removeClass('hidden').addClass('hidden')
        });
        $(this).closest('.btn_lang').find('button i').removeClass().addClass('flag-icon flag-icon-'+$(this).data('code'));
        $(this).parent().parent().find('.active').removeClass('active');
        $(this).parent().addClass('active');
    });
</script>