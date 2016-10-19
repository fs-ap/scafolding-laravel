<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/adminlte-app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/plugins/sweetalert-master/dist/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/js/custom.js') }}" type="text/javascript"></script>

<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("[data-type=mascara-data]").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/aaaa"});
	});
</script>
@stack('scripts-adicionais')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->