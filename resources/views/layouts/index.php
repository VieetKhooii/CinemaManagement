<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script>
    $(document).ready(function() {
        iziToast.success({
            title: 'Success',
            message: 'This is a success message!',
            position: 'topRight'
        });
        
        iziToast.info({
            title: 'Info',
            message: 'This is an info message!',
            position: 'topRight'
        });
        
        iziToast.warning({
            title: 'Warning',
            message: 'This is a warning message!',
            position: 'topRight'
        });
        
        iziToast.error({
            title: 'Error',
            message: 'This is an error message!',
            position: 'topRight'
        });
    });
</script>
