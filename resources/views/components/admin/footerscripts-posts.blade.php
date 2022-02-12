<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="{{ asset('css/admin/assets/js/jquery-1.10.2.js') }}"></script>
<!-- Bootstrap Js -->
<script src="{{ asset('css/admin/assets/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Js -->
<script src="{{ asset('css/admin/assets/js/jquery.metisMenu.js') }}"></script>

<!-- data table scripts -->
<script src="{{ asset('css/admin/assets/js/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('css/admin/assets/js/dataTables/dataTables.bootstrap.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
        console.log('hey');
    });
</script>
<!-- Custom Js -->
<script src="{{ asset('css/admin/assets/js/custom-scripts.js') }}"></script>
