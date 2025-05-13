<?php
    include_once __DIR__ . "/base.inc.php";
?>
<script src="css/moment.min.js"></script>
<script src="css/daterangepicker.js"></script>
<script>
	$(document).ready(function () {
		$(function () {
			$('#date-block').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				timePicker: true,
				timePicker24Hour: true,
				minYear: 2023,
				maxYear: parseInt(moment().format('YYYY'), 10),
				locale: {
					format: 'DD.MM.YYYY HH:mm'
				}
			});
		});
	})
	$('#date-block').on('apply.daterangepicker', function (ev, picker) {
		$(this).val(picker.startDate.format('DD.MM.YYYY HH:mm'))
	});
</script>