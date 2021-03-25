<?php $this->disableAutoLayout(); ?>
<?php if (!empty($filters)) : ?>
    <div class="ml-3">
        <h2 class="h5 bold mb-4">Features & Amenities</h2>
    </div>
    <?php foreach ($filters as $key => $filter) : ?>
        <div class="col-lg-12 mb-3">
            <!-- Title -->
            <div class="mb-2">
                <!-- <h2 class="font-size-1 bold"><?= $filter['name'] ?></h2> -->
                <h4 class="font-size-1 bold"><?= $filter['description'] ?></h4>

            </div>
            <!-- End Title -->

            <div class="row">
                <?php if ($filter->form_type_id == 3) : /*dropdown*/ ?>
                    <!--<div class="row">-->
                    <div class="col-md-4">
                        <?= $this->element('additional_dropdown', ['filter' => $filter, 'business' => $business]) ?>
                    </div>
                    <!--</div>-->
                <?php elseif ($filter->form_type_id == 1) : /*input*/ ?>
                    <!-- <div class="row"> -->
                    <!--<div class="row">-->
                    <div class="col-md-4 mb-3">
                        <div class="js-form-message mb-4">
                            <!-- <label class="bold">
                                Business Name
                                <span class="text-danger">*</span>
                            </label> -->
                            <?= $this->element('additional_input', ['filter' => $filter, 'business' => $business]) ?>

                        </div>
                    </div>
                    <!--</div>-->
                    <?= $this->element('additional_subcats', ['filter' => $filter, 'business' => $business]) ?>
                    <!-- </div> -->
                <?php elseif ($filter->form_type_id == 2) : /*checkbox*/ ?>
                    <?php if (!empty($filter->subcategories)) : ?>
                        <!-- <div class="row"> -->
                        <?= $this->element('additional_subcats', ['filter' => $filter, 'business' => $business]) ?>

                        <!-- </div> -->
                    <?php endif; ?>

                <?php elseif ($filter->form_type_id == 5) : /*slider*/ ?>
                    <div class="col-md-12">
                        <div class="row">
                            <?= $this->element('additional_for_sliders', ['filter' => $filter, 'key' => $key, 'business' => $business]) ?>
                        </div>
                    </div>
                <?php else : ?>
                <?php endif; ?>
            </div>
            <hr>
        </div>
    <?php endforeach; ?>
    <script>
        $.SRCore.components.SRRangeSlider.init('.js-range-slider');

        function updateslider(id, subfix_id) {
            console.log($(id).data('from'));
            console.log($(id).data('to'));
            $('input[id=sliderfrom' + subfix_id + ']').val($(id).data('from'));
            $('input[id=sliderto' + subfix_id + ']').val($(id).data('to'));

        }
        $(function() {
            // https://www.daterangepicker.com/#examples
            $('.timerange').daterangepicker({
                timePicker: true,
                timePicker24Hour: false,
                timePickerIncrement: 1,
                timePickerSeconds: false,
                singleDatePicker: true,
                locale: {
                    format: 'h:mm A'
                }
            }).on('show.daterangepicker', function(ev, picker) {
                picker.container.find(".calendar-table").hide();
            }).on('cancel.daterangepicker', function(ev, picker) {
                //do something, like clearing an input
                $(this).val('');
            });
            // $('.timerange').on('click', function(e) {
            //     e.stopPropagation();
            //     var input = $(this).find('input');

            //     var now = new Date();
            //     var hours = now.getHours();
            //     var period = "PM";
            //     if (hours < 12) {
            //         period = "AM";
            //     } else {
            //         hours = hours - 11;
            //     }
            //     var minutes = now.getMinutes();

            //     var range = {
            //         from: {
            //             hour: hours,
            //             minute: minutes,
            //             period: period
            //         },
            //         to: {
            //             hour: hours,
            //             minute: minutes,
            //             period: period
            //         }
            //     };

            //     if (input.val() !== "") {
            //         var timerange = input.val();
            //         var matches = timerange.match(/([0-9]{2}):([0-9]{2}) (\bAM\b|\bPM\b)-([0-9]{2}):([0-9]{2}) (\bAM\b|\bPM\b)/);
            //         if (matches.length === 7) {
            //             range = {
            //                 from: {
            //                     hour: matches[1],
            //                     minute: matches[2],
            //                     period: matches[3]
            //                 },
            //                 to: {
            //                     hour: matches[4],
            //                     minute: matches[5],
            //                     period: matches[6]
            //                 }
            //             }
            //         }
            //     };
            //     console.log(range);

            //     var html = '<div class="timerangepicker-container">' +
            //         '<div class="timerangepicker-from">' +
            //         '<label class="timerangepicker-label">From:</label>' +
            //         '<div class="timerangepicker-display hour">' +
            //         '<span class="increment fa fa-angle-up"></span>' +
            //         '<span class="value">' + ('0' + range.from.hour).substr(-2) + '</span>' +
            //         '<span class="decrement fa fa-angle-down"></span>' +
            //         '</div>' +
            //         ':' +
            //         '<div class="timerangepicker-display minute">' +
            //         '<span class="increment fa fa-angle-up"></span>' +
            //         '<span class="value">' + ('0' + range.from.minute).substr(-2) + '</span>' +
            //         '<span class="decrement fa fa-angle-down"></span>' +
            //         '</div>' +
            //         ':' +
            //         '<div class="timerangepicker-display period">' +
            //         '<span class="increment fa fa-angle-up"></span>' +
            //         '<span class="value">PM</span>' +
            //         '<span class="decrement fa fa-angle-down"></span>' +
            //         '</div>' +
            //         '</div>' +
            //         '<div class="timerangepicker-to">' +
            //         '<label class="timerangepicker-label">To:</label>' +
            //         '<div class="timerangepicker-display hour">' +
            //         '<span class="increment fa fa-angle-up"></span>' +
            //         '<span class="value">' + ('0' + range.to.hour).substr(-2) + '</span>' +
            //         '<span class="decrement fa fa-angle-down"></span>' +
            //         '</div>' +
            //         ':' +
            //         '<div class="timerangepicker-display minute">' +
            //         '<span class="increment fa fa-angle-up"></span>' +
            //         '<span class="value">' + ('0' + range.to.minute).substr(-2) + '</span>' +
            //         '<span class="decrement fa fa-angle-down"></span>' +
            //         '</div>' +
            //         ':' +
            //         '<div class="timerangepicker-display period">' +
            //         '<span class="increment fa fa-angle-up"></span>' +
            //         '<span class="value">PM</span>' +
            //         '<span class="decrement fa fa-angle-down"></span>' +
            //         '</div>' +
            //         '</div>' +
            //         '</div>';

            //     $(html).insertAfter(this);
            //     $('.timerangepicker-container').on(
            //         'click',
            //         '.timerangepicker-display.hour .increment',
            //         function() {
            //             var value = $(this).siblings('.value');
            //             value.text(
            //                 increment(value.text(), 12, 1, 2)
            //             );
            //         }
            //     );

            //     $('.timerangepicker-container').on(
            //         'click',
            //         '.timerangepicker-display.hour .decrement',
            //         function() {
            //             var value = $(this).siblings('.value');
            //             value.text(
            //                 decrement(value.text(), 12, 1, 2)
            //             );
            //         }
            //     );

            //     $('.timerangepicker-container').on(
            //         'click',
            //         '.timerangepicker-display.minute .increment',
            //         function() {
            //             var value = $(this).siblings('.value');
            //             value.text(
            //                 increment(value.text(), 59, 0, 2)
            //             );
            //         }
            //     );

            //     $('.timerangepicker-container').on(
            //         'click',
            //         '.timerangepicker-display.minute .decrement',
            //         function() {
            //             var value = $(this).siblings('.value');
            //             value.text(
            //                 decrement(value.text(), 12, 1, 2)
            //             );
            //         }
            //     );

            //     $('.timerangepicker-container').on(
            //         'click',
            //         '.timerangepicker-display.period .increment, .timerangepicker-display.period .decrement',
            //         function() {
            //             var value = $(this).siblings('.value');
            //             var next = value.text() == "PM" ? "AM" : "PM";
            //             value.text(next);
            //         }
            //     );

            // });

            // $(document).on('click', e => {

            //     if (!$(e.target).closest('.timerangepicker-container').length) {
            //         if ($('.timerangepicker-container').is(":visible")) {
            //             var timerangeContainer = $('.timerangepicker-container');
            //             if (timerangeContainer.length > 0) {
            //                 var timeRange = {
            //                     from: {
            //                         hour: timerangeContainer.find('.value')[0].innerText,
            //                         minute: timerangeContainer.find('.value')[1].innerText,
            //                         period: timerangeContainer.find('.value')[2].innerText
            //                     },
            //                     to: {
            //                         hour: timerangeContainer.find('.value')[3].innerText,
            //                         minute: timerangeContainer.find('.value')[4].innerText,
            //                         period: timerangeContainer.find('.value')[5].innerText
            //                     },
            //                 };

            //                 timerangeContainer.parent().find('input').val(
            //                     timeRange.from.hour + ":" +
            //                     timeRange.from.minute + " " +
            //                     timeRange.from.period + "-" +
            //                     timeRange.to.hour + ":" +
            //                     timeRange.to.minute + " " +
            //                     timeRange.to.period
            //                 );
            //                 timerangeContainer.remove();
            //             }
            //         }
            //     }

            // });

            // function increment(value, max, min, size) {
            //     var intValue = parseInt(value);
            //     if (intValue == max) {
            //         return ('0' + min).substr(-size);
            //     } else {
            //         var next = intValue + 1;
            //         return ('0' + next).substr(-size);
            //     }
            // }

            // function decrement(value, max, min, size) {
            //     var intValue = parseInt(value);
            //     if (intValue == min) {
            //         return ('0' + max).substr(-size);
            //     } else {
            //         var next = intValue - 1;
            //         return ('0' + next).substr(-size);
            //     }
            // }
            // $('timerange').daterangepicker({
            //     timePicker: true,
            //     startDate: moment().startOf('hour'),
            //     endDate: moment().startOf('hour').add(32, 'hour'),
            //     locale: {
            //         format: 'M/DD hh:mm A'
            //     }
            // });
        });
    </script>
    <!--<input type="hidden" name="additional_features_key" value=<?php //implode(",", $additional_features_keys) 
                                                                    ?> />-->
<?php endif; ?>