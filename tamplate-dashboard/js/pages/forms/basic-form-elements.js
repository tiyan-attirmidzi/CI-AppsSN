$(function () {
    //Textarea auto growth
    autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm:00',
        clearButton: true,
        weekStart: 1
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });

    //Bootstrap datepicker plugin
    $('#bs_datepicker_container input').datepicker({
        autoclose: true,
        container: '#bs_datepicker_container'
    });

    $('#bs_datepicker_component_container').datepicker({
        autoclose: true,
        container: '#bs_datepicker_component_container'
    });
    //
    $('#bs_datepicker_range_container').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container'
    });
});