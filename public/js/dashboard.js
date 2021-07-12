/*!
 * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
 */
(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    $(document).ready(function() {
        var lang = $('meta[name="locale"]').attr('content');
        var dateFormat = lang == 'de' ? 'dd-mm-yy' : 'mm-dd-yy';

        // Call the dataTables jQuery plugin
        $('#dataTable').DataTable();

        // Call the datePicker jQuery plugin
        $('.date-picker').datepicker({
            'dateFormat': dateFormat,
            'onSelect': function(dateString, d) {

            }
        });

        // Init select2 elements.
        $('select#institution_id, select#user_id, select#patient_id, select#coupon_id, select#folder_id').select2({
            theme: 'bootstrap4',
        });
    });
})(jQuery);

addInvoiceLine = () => {
    $.ajax({
        type: "GET",
        url: '/dashboard/invoices/addInvoiceLine',
        success: function(html) {
            $('#invoicelines').append(html);
        }
    });
}

removeInvoiceLine = (id) => {
    document.getElementById(id).outerHTML = '';
}