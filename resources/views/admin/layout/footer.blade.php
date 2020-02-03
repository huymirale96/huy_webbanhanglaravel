<script src="js/jquery.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/adminlte.min.js"></script>
<script src="js/datatables.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/admin-product.js"></script>
<script src="js/admin-brand.js"></script>
<script src="js/admin-category.js"></script>
<script src="js/admin-account.js"></script>
<script src="js/admin-customer.js"></script>
<script src="js/admin-new.js"></script>
<script src="js/admin-order.js"></script>
<script src="js/admin-banner.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="./../ckeditor/ckeditor.js"></script>
<script src="js/jquery.toast.min.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor', {
        height: 600,
        filebrowserBrowseUrl: '{{ asset('public/asset/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('public/asset/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('public/asset/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('public/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('public/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('public/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });

    CKEDITOR.replace('editor_short', {
        height: 200,
        filebrowserBrowseUrl: '{{ asset('public/asset/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('public/asset/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('public/asset/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('public/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('public/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('public/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
</script>
</body>
</html>
