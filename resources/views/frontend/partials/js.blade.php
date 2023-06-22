<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script src="{{ asset('frontend/js/cart.js') }}"></script>
<script src="{{ asset('frontend/silck/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/product.js') }}"></script>
@stack('js')
