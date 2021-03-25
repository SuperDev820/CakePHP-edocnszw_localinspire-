<script>
    toastr.options = {
        "closeButton": false,
        "escapeHtml": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function secTime(val) {
        return val > 9 ? val : "0" + val;
    }


    function updateQueryString(key, value, url) {
        if (!url) url = window.location.href;
        var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
            hash;

        if (re.test(url)) {
            if (typeof value !== 'undefined' && value !== null)
                return url.replace(re, '$1' + key + "=" + value + '$2$3');
            else {
                hash = url.split('#');
                url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            }
        } else {
            if (typeof value !== 'undefined' && value !== null) {
                var separator = url.indexOf('?') !== -1 ? '&' : '?';
                hash = url.split('#');
                url = hash[0] + separator + key + '=' + value;
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            } else
                return url;
        }
    }


    function showLoading() {
        $.blockUI({
            message: '<h5><img src="<?= $this->Url->build("/", ['fullBase' => true]); ?>busy.gif" /> Just a moment...</h5>',
            css: {
                'border-radius': '20px'
            }
        });
    }

    function hideLoading() {
        $.unblockUI();
    }

    function block(target) {
        if (target) {
            App.blockUI({
                animate: true,
                target: target,
                overlayColor: 'none',
            });
        } else {
            App.blockUI({
                animate: true,
                overlayColor: 'none',
            });
        }
    }

    function unblock(target) {
        if (target) {
            App.unblockUI(target);
        }
        App.unblockUI();
        $.unblockUI();
    }

    function jsNumberFormat(n) {
        //var n = 100000;
        var value = n.toLocaleString(
            undefined, // leave undefined to use the browser's locale,
            // or use a string like 'en-US' to override it.
            {
                minimumFractionDigits: 0
            }
        );
        // console.log(value);
        return value
    }



    $(document).ready(function() {

        $(".datepicker").datepicker({
            format: 'yyyy/mm/dd',
        });

        // console.log("select2");
        $('.select2').select2({
            placeholder: 'Select an option',
            theme: "classic"
        });

        $('.select2_multiple').select2({
            theme: "classic",
            placeholder: "select one or more options",
            allowClear: true,
            maximumSelectionLength: 7,
        });

        $('.filters_subcat_select').select2({
            theme: "classic",
            placeholder: "Select one or more options",
            allowClear: true,
            maximumSelectionLength: 20,
        });


        // $('.lazy').Lazy();

        jQuery(document).on('change', '#limitBox', function(e) {
            var parentForm = $(this).closest("form");
            parentForm.submit();

        });

        jQuery(document).on('change', '#activeCountrySelect', function(e) {

            var parentForm = $(this).closest("form");
            parentForm.submit();

        });

    });
</script>